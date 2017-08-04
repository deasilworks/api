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

namespace deasilworks\api\Model;

use deasilworks\api\UUID;

/**
 * Class PkgModel.
 *
 * API metadata
 */
class PkgModel
{
    /**
     * @var string
     */
    protected $pkgUuid;

    /**
     * @var \DateTime
     */
    protected $pkgDateTime;

    /**
     * @var mixed
     */
    protected $client;

    /**
     * @var string
     */
    protected $payload;

    /**
     * PkgModel constructor.
     *
     * @SuppressWarnings(StaticAccess)
     */
    public function __construct()
    {
        $this->pkgUuid = UUID::v4();
        $this->pkgDateTime = new \DateTime();
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
     * @return PkgModel
     */
    public function setPkgUuid($pkgUuid)
    {
        $this->pkgUuid = $pkgUuid;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPkgDateTime()
    {
        return $this->pkgDateTime;
    }

    /**
     * @param \DateTime $pkgDateTime
     *
     * @return PkgModel
     */
    public function setPkgDateTime($pkgDateTime)
    {
        $this->pkgDateTime = $pkgDateTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     *
     * @return PkgModel
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     *
     * @return PkgModel
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }
}
