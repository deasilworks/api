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

namespace deasilworks\api\model;

/**
 * Class ActionModel.
 *
 * Stores attributes of an action
 */
class ActionModel
{
    /**
     * @var string
     */
    protected $classMethod;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var string
     */
    protected $restMethod;

    /**
     * @var ParamCollection
     */
    protected $paramCollection;

    /**
     * @return string
     */
    public function getClassMethod()
    {
        return $this->classMethod;
    }

    /**
     * @param string $classMethod
     * @return ActionModel
     */
    public function setClassMethod($classMethod)
    {
        $this->classMethod = $classMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     * @return ActionModel
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
        return $this;
    }

    /**
     * @return string
     */
    public function getRestMethod()
    {
        return $this->restMethod;
    }

    /**
     * @param string $restMethod
     * @return ActionModel
     */
    public function setRestMethod($restMethod)
    {
        $this->restMethod = $restMethod;
        return $this;
    }

    /**
     * @return ParamCollection
     */
    public function getParamCollection()
    {
        return $this->paramCollection;
    }

    /**
     * @param ParamCollection $paramCollection
     * @return ActionModel
     */
    public function setParamCollection($paramCollection)
    {
        $this->paramCollection = $paramCollection;
        return $this;
    }

}
