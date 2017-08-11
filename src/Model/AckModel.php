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

use deasilworks\API\UUID;

/**
 * Class AckModel.
 *
 * API metadata
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class AckModel
{
    /**
     * @var int
     */
    protected $ackVersion = 4;

    /**
     * @var string
     */
    protected $ackUuid;

    /**
     * @var string
     */
    protected $pkgUuid;

    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @var int
     */
    protected $serverCode;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorClass;

    /**
     * @var mixed
     */
    protected $errorPayload;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var string
     */
    protected $apiLevel;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var array
     */
    protected $locationParams;

    /**
     * @var array
     */
    protected $requestArgs;

    /**
     * @var string
     */
    protected $payloadClass;

    /**
     * @var mixed
     */
    protected $payload;

    /**
     * AckModel constructor.
     *
     * @SuppressWarnings(StaticAccess)
     */
    public function __construct()
    {
        $this->ackUuid = UUID::getV4();
        $this->apiLevel = 1;
        $this->dateTime = new \DateTime();
    }

    /**
     * @return int
     */
    public function getAckVersion()
    {
        return $this->ackVersion;
    }

    /**
     * @return string
     */
    public function getAckUuid()
    {
        return $this->ackUuid;
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
     * @return AckModel
     */
    public function setPkgUuid($pkgUuid)
    {
        $this->pkgUuid = $pkgUuid;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return int
     */
    public function getServerCode()
    {
        return $this->serverCode;
    }

    /**
     * @param int $serverCode
     *
     * @return AckModel
     */
    public function setServerCode($serverCode)
    {
        $this->serverCode = $serverCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     *
     * @return AckModel
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param string $errorCode
     *
     * @return AckModel
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorClass()
    {
        return $this->errorClass;
    }

    /**
     * @param string $errorClass
     *
     * @return AckModel
     */
    public function setErrorClass($errorClass)
    {
        $this->errorClass = $errorClass;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorPayload()
    {
        return $this->errorPayload;
    }

    /**
     * @param mixed $errorPayload
     *
     * @return AckModel
     */
    public function setErrorPayload($errorPayload)
    {
        $this->errorPayload = $errorPayload;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
     * @return AckModel
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiLevel()
    {
        return $this->apiLevel;
    }

    /**
     * @param string $apiLevel
     *
     * @return AckModel
     */
    public function setApiLevel($apiLevel)
    {
        $this->apiLevel = $apiLevel;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     *
     * @return AckModel
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return array
     */
    public function getLocationParams()
    {
        return $this->locationParams;
    }

    /**
     * @param array $locationParams
     *
     * @return AckModel
     */
    public function setLocationParams($locationParams)
    {
        $this->locationParams = $locationParams;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequestArgs()
    {
        return $this->requestArgs;
    }

    /**
     * @param array $requestArgs
     *
     * @return AckModel
     */
    public function setRequestArgs($requestArgs)
    {
        $this->requestArgs = $requestArgs;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayloadClass()
    {
        return $this->payloadClass;
    }

    /**
     * @param string $payloadClass
     *
     * @return AckModel
     */
    public function setPayloadClass($payloadClass)
    {
        $this->payloadClass = $payloadClass;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     *
     * @return AckModel
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }
}
