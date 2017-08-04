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

use deasilworks\api\model\AckModel;
use deasilworks\api\model\ActionResponseModel;
use deasilworks\api\model\ApiResultModel;
use deasilworks\api\model\HttpRequestModel;
use Doctrine\Common\Annotations\AnnotationRegistry;
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
     * Execute API call.
     *
     * @param HttpRequestModel $apiRequest
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function execute(HttpRequestModel $apiRequest)
    {
        $result = new ApiResultModel();

        list($controller, $action, $args) = $this->resolveController($apiRequest->getPath());

        $actionReader = new ActionReader($controller);

        if ($apiRequest->getMethod() == 'OPTIONS') {
            $ack = $this->optionsAck($actionReader, $action);

            return $result
                ->setContent($this->serialize($ack))
                ->setJson(true)
                ->setHeaders(['Allow' => 'OPTIONS, GET, POST'])
                ->setStatusCode(200);
        }

        $ack = $this->callAction($actionReader, $apiRequest, $action, $args);

        return $result
            ->setContent($this->serialize($ack))
            ->setJson(true) // serialized ^
            ->setStatusCode($ack->getServerCode());
    }

    /**
     * Ack Options.
     *
     * @param ActionReader $actionReader
     * @param string       $action
     *
     * @return AckModel
     */
    private function optionsAck($actionReader, $action)
    {
        $actionMeta = $actionReader->getActionCollection()[$action];

        $ack = new AckModel();
        $ack
            ->setServerCode(200)
            ->setSuccess(true)
            ->setPayload($actionMeta);

        return $ack;
    }

    /**
     * Serialize.
     *
     * @param $object
     *
     * @return string
     */
    private function serialize($object)
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $serializer = SerializerBuilder::create()->build();

        return $serializer->serialize($object, 'json', $context);
    }

    /**
     * Call Action.
     *
     * @param ActionReader     $actionReader
     * @param HttpRequestModel $apiRequest
     * @param $action
     * @param $args
     *
     * @return AckModel
     */
    private function callAction($actionReader, $apiRequest, $action, $args)
    {
        $actionExecutor = new ActionExecutor($actionReader);

        /** @var ActionResponseModel $actionResponse */
        $actionResponse = $actionExecutor->execute($apiRequest, $action, $args);

        // TODO: if this is empty set header to 404

        $ack = new AckModel();

        $class = '';
        if (is_object($actionResponse->getResponse())) {
            $class = get_class($actionResponse->getResponse());
        }

        $ack
            ->setSuccess(true)
            ->setServerCode('200')
            ->setLocation($apiRequest->getPath())
            ->setLocationParams($actionResponse->getParams())
            ->setRequestArgs($actionResponse->getArgs())
            ->setPayloadClass($class)
            ->setPayload($actionResponse->getResponse());

        return $ack;
    }

    /**
     * Resolves controller to object and remaining args.
     *
     * @param $path
     *
     * @throws \Exception
     *
     * @return array
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

            $class = $class.'\\'.ucfirst($pathComponent);
            $classAlias .= ucfirst($pathComponent);

            // check for an alias first
            if (isset($aliases[strtolower($classAlias)])) {
                $aliasClass = $baseClassPath.'\\'.$aliases[strtolower($classAlias)];

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
