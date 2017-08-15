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

namespace deasilworks\API\ServiceProvider\Silex;

use deasilworks\API\Model\AckModel;
use deasilworks\API\Model\ExceptionModel;
use deasilworks\CFG\ServiceProvider\Silex\ServiceProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader('class_exists');

/**
 * Class APIServiceProvider.
 *
 * Responsible for providing API as a service to
 * the applications built on the Silex framework.
 */
class APIErrorServiceProvider extends ServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // error handling
        $app->error($app[$this->namespace.'api.error_handler']);
    }

    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        // error handler
        $container[$this->namespace.'api.error_handler'] = function ($container) {
            return function (\Exception $exception, Request $request, $code) use ($container) {
                $matches = [];
                preg_match('/^\/('.ApiServiceProvider::API_PATH.')\/.*/i', $request->getPathInfo(), $matches);

                // pass through if this is not a api call
                if (!isset($matches[1])) {
                    return false;
                }

                $exceptionModel = new ExceptionModel($exception);

                $ack = new AckModel();

                $response = new Response();
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(
                    $ack
                        ->setServerCode($code)
                        ->setLocation($request->getPathInfo())
                        ->setSuccess(false)
                        ->setErrorClass(get_class($exceptionModel))
                        ->setErrorPayload($exceptionModel)
                        ->setErrorMessage($exceptionModel->getMessage())
                        ->toJson()
                );

                return $response;
            };
        };
    }
}
