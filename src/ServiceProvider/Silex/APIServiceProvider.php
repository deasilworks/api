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

namespace deasilworks\api\ServiceProvider\Silex;

use deasilworks\api\API;
use deasilworks\api\APIConfig;
use deasilworks\api\model\HttpRequestModel;
use deasilworks\cfg\ServiceProvider\Silex\ServiceProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class APIServiceProvider.
 *
 * Responsible for providing API as a service to
 * the applications built on the Silex framework.
 */
class APIServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        // the api
        $container[$this->namespace.'.api'] = function ($container) {
            $configKey = $this->namespace.'.api.config';

            if (!isset($container[$configKey])) {
                $container[$configKey] = new APIConfig();
            }

            /** @var APIConfig $config */
            $config = $container[$configKey];

            $api = new API($config);

            // if no controller factory is specified see if we have a CEF
            // controller_factory at this namespace to use as default
            //
            if (!isset($container[$this->namespace.'.api.controller_factory'])) {
                $controllerFactory = $container[$this->namespace.'.cef.controller_factory'];

                if (isset($controllerFactory)) {
                    $container[$this->namespace.'.api.controller_factory'] = $controllerFactory;
                }
            }

            // if no seralizer is specified use CEF
            //
            if (!isset($container[$this->namespace.'.api.serializer'])) {
                $seralizer = $container[$this->namespace.'.cef.serializer'];

                if (isset($seralizer)) {
                    $container[$this->namespace.'.api.serializer'] = $seralizer;
                }
            }

            $this->populateConfig('api', $container);

            return $api;
        };

        // api responder
        $container[$this->namespace.'.api.responder'] = function (Application $app) {
            return function (Request $request, $path) use ($app) {
                $apiRequest = new HttpRequestModel();
                $apiRequest
                    ->setMethod($request->getMethod())
                    ->setPath($path)
                    ->setContentType($request->getContentType())
                    ->setQueryString($request->getQueryString())
                    ->setContent($request->getContent())
                    ->setSession($request->getSession());

                $response = new JsonResponse(
                    $app[$this->namespace.'.api']->execute($apiRequest), 200, [], true
                );

                return $response;
            };
        };
    }
}
