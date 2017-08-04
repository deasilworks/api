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

use deasilworks\API\UUID;

/**
 * Class ComponentsTest.
 *
 * @SuppressWarnings(PHPMD)
 * We do bad things here and we like it.
 */
class ComponentsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test API Models.
     */
    public function testModels()
    {
        $ackModel = new \deasilworks\API\Model\AckModel();
        $ackModel
            ->setErrorClass('ErrorClass')
            ->setErrorCode('ErrorCode')
            ->setErrorPayload('ErrorPlayload')
            ->setErrorMessage('ErrorMessage')
            ->setLocation('test/page')
            ->setPayload('Test')
            ->setSuccess(true)
            ->setServerCode(200);

        $this->assertEquals('ErrorClass', $ackModel->getErrorClass());
        $this->assertEquals('ErrorCode', $ackModel->getErrorCode());
        $this->assertEquals('ErrorPlayload', $ackModel->getErrorPayload());
        $this->assertEquals('ErrorMessage', $ackModel->getErrorMessage());
        $this->assertEquals('Test', $ackModel->getPayload());
        $this->assertTrue($ackModel->isSuccess());
        $this->assertEquals(200, $ackModel->getServerCode());

        $paramModel = new \deasilworks\API\Model\ParamModel();
        $paramModel
            ->setType('')
            ->setName('testParam');

        $this->assertEquals('testParam', $paramModel->getName());
        $this->assertEquals('', $paramModel->getType());

        $paramCollection = new \deasilworks\API\Model\ParamCollection();
        $paramCollection
            ->addModel($paramModel);

        $this->assertInstanceOf(get_class($paramModel), $paramCollection->current());

        $actionModel = new \deasilworks\API\Model\Action\ActionModel();
        $actionModel
            ->setClassMethod('getTest')
            ->setParamCollection($paramCollection)
            ->setRestMethod('GET')
            ->setRouteName('test_path');

        $this->assertEquals('getTest', $actionModel->getClassMethod());
        $this->assertInstanceOf(get_class($paramCollection), $actionModel->getParamCollection());
        $this->assertEquals('GET', $actionModel->getRestMethod());
        $this->assertEquals('test_path', $actionModel->getRouteName());

        $actionCollection = new \deasilworks\API\Model\ActionCollection();
        $actionCollection
            ->addModel($actionModel);

        $this->assertInstanceOf(get_class($actionModel), $actionCollection->current());
    }

    /**
     * Test UUID.
     */
    public function testUuid()
    {
        $this->assertTrue(UUID::isValid(UUID::v4()));
    }

    /**
     * Test Hydrator Simple Object.
     */
    public function testHydratorSimple()
    {
        $dateTime = new \DateTime();
        $hydrator = new \deasilworks\API\Hydrator();

        $pkgModel = new \deasilworks\API\Model\PkgModel();

        $this->assertTrue(UUID::isValid($pkgModel->getPkgUuid()));

        $json = '{
            "pkg_uuid": "'.UUID::v4().'",
            "pkg_date_time": "'.$dateTime->format(DateTime::ATOM).'",
            "payload": "Test payload."
        }';

        $obj = json_decode($json);

        $pkgModel = $hydrator->hydrateObject($pkgModel, $obj);

        $this->assertEquals('Test payload.', $pkgModel->getPayload());
    }

    /**
     * Test Hydrator Complex Object.
     */
    public function testHydratorComplex()
    {
        $hydrator = new \deasilworks\API\Hydrator();

        $dryActionCollection = new \deasilworks\API\Model\ActionCollection();

        $json = file_get_contents(__DIR__.'/resources/action_collection.json');
        $obj = json_decode($json);

        /** @var \deasilworks\API\Model\ActionCollection $actionCollection */
        $actionCollection = $hydrator->hydrateObject($dryActionCollection, $obj);

        $this->assertTrue(method_exists($actionCollection, 'addModel'));
        $this->assertEquals('getTestB', $actionCollection['test-page-b']['GET']->getClassMethod());
        $this->assertEquals('setTestB', $actionCollection['test-page-b']['POST']->getClassMethod());

        /** @var \deasilworks\API\Model\Action\ActionModel $get */
        $actionModel = $actionCollection['test-page-b']['GET'];

        $this->assertInstanceOf('\deasilworks\API\Model\Action\ActionModel', $actionModel);

        /** @var \deasilworks\API\Model\ParamCollection $paramCollection */
        $paramCollection = $actionModel->getParamCollection();

        $this->assertInstanceOf('\deasilworks\API\Model\ParamCollection', $paramCollection);

        /** @var \deasilworks\API\Model\ParamModel $paramModel */
        $paramModel = $paramCollection->current();

        $this->assertInstanceOf('\deasilworks\API\Model\ParamModel', $paramModel);

        $this->assertTrue(method_exists($paramModel, 'getName'));
        $this->assertTrue(method_exists($paramModel, 'getType'));
    }
}
