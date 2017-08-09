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

namespace deasilworks\API;

/**
 * Class APIConfig.
 */
final class APIConfig
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var callable
     */
    private $controllerFactory;

    /**
     * @var callable
     */
    private $serializer;

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     *
     * @return APIConfig
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;

        return $this;
    }

    /**
     * Add or set a route.
     *
     * @param array
     *
     * @return array
     */
    public function setRoute($route, $config)
    {
        return $this->routes[$route] = $config;
    }

    /**
     * @param string $route
     *
     * @return string
     */
    public function getClassPath($route)
    {
        return $this->routes[$route]['class_path'];
    }

    /**
     * @param string $route
     *
     * @return array
     */
    public function getAliases($route)
    {
        return $this->routes[$route]['aliases'];
    }

    /**
     * @return callable
     */
    public function getControllerFactory()
    {
        return $this->controllerFactory;
    }

    /**
     * @param callable $controllerFactory
     *
     * @return APIConfig
     */
    public function setControllerFactory($controllerFactory)
    {
        $this->controllerFactory = $controllerFactory;

        return $this;
    }

    /**
     * @return callable
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param callable $serializer
     *
     * @return APIConfig
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;

        return $this;
    }
}
