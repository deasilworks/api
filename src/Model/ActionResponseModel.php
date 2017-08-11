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

namespace deasilworks\API\Model;

/**
 * Class ActionResponseModel.
 */
class ActionResponseModel
{
    /**
     * @var mixed
     */
    protected $response;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var array
     */
    protected $args;

    /**
     * @var string
     */
    protected $pkgUuid;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     *
     * @return ActionResponseModel
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     *
     * @return ActionResponseModel
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param array $args
     *
     * @return ActionResponseModel
     */
    public function setArgs($args)
    {
        $this->args = $args;

        return $this;
    }

    /**
     * @return string
     */
    public function getPkgUuid()
    {
        return $this->pkgUuid;
    }

    /**
     * @param string $pkgUuid
     *
     * @return ActionResponseModel
     */
    public function setPkgUuid($pkgUuid)
    {
        $this->pkgUuid = $pkgUuid;

        return $this;
    }
}
