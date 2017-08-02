<?php

/*
 * MIT License
 *
 * Copyright (c) 2017 Deasil Works, Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace deasilworks\api;

use deasilworks\api\Annotation\ApiAction;
use deasilworks\api\Annotation\ApiController;
use deasilworks\api\model\ActionCollection;
use deasilworks\api\model\ActionModel;
use deasilworks\api\model\ParamCollection;
use deasilworks\api\model\ParamModel;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;

/**
 * Class ControllerAction.
 *
 * Responsible resolving a controller based
 * on a name and returning ActionModels
 */
class ActionReader
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var object
     */
    private $controller;

    /**
     * @var ActionCollection
     */
    private $actionCollection;

    /**
     * Resolver constructor.
     *
     * @param $controller
     */
    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->actionCollection = new ActionCollection();
        $this->reader = new AnnotationReader();
        $this->resolve();
    }

    /**
     * @return object
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return ActionCollection
     */
    public function getActionCollection()
    {
        return $this->actionCollection;
    }

    private function resolve()
    {
        // get the reflection object and associated annotation
        //
        $reflectionObject = new \ReflectionObject($this->controller);
        $classAnnotation = $this->reader->getClassAnnotation($reflectionObject, ApiController::class);

        if ($classAnnotation && $classAnnotation->isRoutable()) {

            // this is a routable object so resolve any methods it exposes
            //
            $this->resolveActions($reflectionObject);
        }
    }

    /**
     * @param \ReflectionObject $reflectionObject
     */
    private function resolveActions(\ReflectionObject $reflectionObject)
    {
        /** @var \ReflectionMethod $reflectionMethod */
        foreach ($reflectionObject->getMethods() as $reflectionMethod) {

            /** @var ApiAction $methodAnnotation */
            $ApiMethodAno = $this->reader->getMethodAnnotation($reflectionMethod, ApiAction::class);

            if ($ApiMethodAno && $ApiMethodAno->isRoutable()) {
                $actionTypeName = $this->parseActionMethod($reflectionMethod->getName());

                $actionModel = new ActionModel();
                $actionModel
                    ->setClassMethod($reflectionMethod->getName())
                    ->setRouteName($actionTypeName['name'])
                    ->setRestMethod($actionTypeName['type'])
                    ->setParamCollection($this->resolveActionParams($reflectionMethod));

                $this->actionCollection->addModel($actionModel);
            }
        }
    }

    /**
     * @param $methodName
     *
     * @return array
     */
    private function parseActionMethod($methodName)
    {
        $actionTypeName = [
            'type' => null,
            'name' => null,
        ];

        preg_match('/(get|set|update|delete|remove)([A-Z].+)/', $methodName, $matches);

        if (isset($matches[1])) {
            // a couple of aliases
            $matches[1] == 'set' ? $matches[1] = 'POST' : false;
            $matches[1] == 'remove' ? $matches[1] = 'DELETE' : false;

            $actionTypeName['type'] = strtoupper($matches[1]);
        }

        if (isset($matches[2])) {
            $actionTypeName['name'] = lcfirst($matches[2]);
        }

        return $actionTypeName;
    }

    /**
     * @param \ReflectionMethod $reflectionMethod
     *
     * @return ParamCollection
     */
    private function resolveActionParams(\ReflectionMethod $reflectionMethod)
    {
        $paramCollection = new ParamCollection();
        $params = $reflectionMethod->getParameters();

        foreach ($params as $param) {
            $paramModel = new ParamModel();
            $paramModel->setName($param->getName());

            if ($paramClass = $param->getClass()) {
                $paramModel->setType($paramClass->getName());
            }

            $paramCollection->addModel($paramModel);
        }

        return $paramCollection;
    }
}
