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

/**
 * Class APIConfig.
 */
final class APIConfig
{
    /**
     * @var string
     */
    private $classPath;

    /**
     * @var array hash of aliases
     */
    private $aliases = [];

    /**
     * @var callable
     */
    private $controllerFactory;

    /**
     * @var callable
     */
    private $serializer;

    /**
     * @return string
     */
    public function getClassPath()
    {
        return $this->classPath;
    }

    /**
     * @param array $classPath
     *
     * @return APIConfig
     */
    public function setClassPath($classPath)
    {
        $this->classPath = $classPath;

        return $this;
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * @param array $aliases
     *
     * @return APIConfig
     */
    public function setAliases($aliases)
    {
        $this->aliases = $aliases;

        return $this;
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
