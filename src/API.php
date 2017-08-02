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

use deasilworks\api\model\ActionResponseModel;
use deasilworks\api\model\HttpRequestModel;
use Doctrine\Common\Annotations\AnnotationRegistry;
use deasilworks\api\model\AckModel;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

AnnotationRegistry::registerLoader('class_exists');

/**
 * Class CEF.
 *
 * Responsible for managing configuration and
 * providing an EntityManager factory.
 */
class API
{
    /**
     * @var APIConfig
     */
    private $config;

    /**
     * API constructor.
     *
     * @param APIConfig $config
     */
    public function __construct(APIConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Execute API call
     *
     * @param HttpRequestModel $apiRequest
     * @return mixed
     * @throws \Exception
     */
    public function execute(HttpRequestModel $apiRequest)
    {
        list($controller, $action, $args) = $this->resolveController($apiRequest->getPath());

        $controllerAction = new ControllerAction($controller);

        /** @var ActionResponseModel $actionResponse */
        $actionResponse = $controllerAction->call($apiRequest, $action, $args);

        $ack = new AckModel();

        $ack
            ->setSuccess(true)
            ->setServerCode("200")
            ->setLocation($apiRequest->getPath())
            ->setLocationParams($actionResponse->getParams())
            ->setRequestArgs($actionResponse->getArgs())
            ->setPayloadClass(get_class($actionResponse))
            ->setPayload($actionResponse->getResponse());

        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $serializer = SerializerBuilder::create()->build();
        return $serializer->serialize($ack, 'json', $context);
    }

    /**
     * Resolves controller to object and remaining args.
     *
     * @param $path
     * @return array
     * @throws \Exception
     */
    private function resolveController($path)
    {
        $pathComponents = explode('/', $path);
        $baseClassPath = $this->config->getClassPath();

        $classObject = null;
        $aliases = $this->config->getAliases();

        $class = $baseClassPath;
        $classAlias = '';

        $controllerFactory = $this->config->getControllerFactory();

        while ($pathComponents) {
            $pathComponent = array_shift($pathComponents);

            $class = $class . '\\' . ucfirst($pathComponent);
            $classAlias .= ucfirst($pathComponent);

            // check for an alias first
            if (isset($aliases[strtolower($classAlias)])) {

                $aliasClass = $baseClassPath . '\\' . $aliases[strtolower($classAlias)];

                if (class_exists($aliasClass)) {
                    $classObject = $controllerFactory($aliasClass);
                    break;
                }
            }

            if (class_exists($class)) {
                $classObject = $controllerFactory($class);
                break;
            }

            $classAlias .= '/';
        }

        if (!$classObject) {
            throw new \Exception('API: No controller found for the requested end point.');
        }

        // any path left over becomes args
        $pathArgs = $pathComponents;

        return [$classObject, array_shift($pathArgs), $pathArgs];
    }

}
