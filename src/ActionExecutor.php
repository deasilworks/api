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

use deasilworks\api\model\ActionModel;
use deasilworks\api\model\ActionResponseModel;
use deasilworks\api\model\HttpRequestModel;
use deasilworks\api\model\ParamModel;

/**
 * Class ControllerAction.
 *
 * Responsible resolving a controller based
 * on a name and returning ActionModels
 */
class ActionExecutor
{
    /**
     * @var ActionReader
     */
    protected $actionReader;

    /**
     * Resolver constructor.
     *
     * @param ActionReader $actionReader
     */
    public function __construct(ActionReader $actionReader)
    {
        $this->actionReader = $actionReader;
    }

    /**
     * @param HttpRequestModel $apiRequest
     * @param $action
     * @param $args
     *
     * @throws \Exception
     *
     * @return $response
     */
    public function execute(HttpRequestModel $apiRequest, $action, $args)
    {
        $actionReader = $this->actionReader;
        $response = new ActionResponseModel();

        $actionCollection = $actionReader->getActionCollection();

        /** @var ActionModel $targetAction */
        if (!isset($actionCollection[$action][$apiRequest->getMethod()])) {
            throw new \Exception('Method ' . $apiRequest->getMethod() . ' not supported by ' . $action . ' action.');
        }

        $targetAction = $actionCollection[$action][$apiRequest->getMethod()];

        if (!isset($targetAction)) {
            throw new \Exception('Unknown action "'.$action.'" for this controller.');
        }

        $query = [];
        parse_str($apiRequest->getQueryString(), $query);

        $content = [];

        // assume txt to be json
        if ($apiRequest->getContentType() == 'form') {
            parse_str($apiRequest->getContent(), $content);
        }

        list ($preparedArgs, $params) = $this->prepareArgs($targetAction, $args, $query, $content);

        $callAction = [$actionReader->getController(), $targetAction->getClassMethod()];
        $callResponse = call_user_func_array($callAction, $preparedArgs);

        if ($callResponse) {
            $response
                ->setArgs($this->sanitizeArgs($preparedArgs))
                ->setParams($params)
                ->setResponse($callResponse);
        }

        return $response;
    }

    /**
     * Prepare Args
     *
     * @param ActionModel $targetAction
     * @param $args
     * @param $query
     * @return array
     */
    private function prepareArgs(ActionModel $targetAction, $args, $query, $content)
    {
        $preparedArgs = [];
        $paramIndex = 0;
        $params = [];

        /** @var ParamModel $param */
        foreach ($targetAction->getParamCollection() as $param) {
            $params[$paramIndex] = $param;

            if (isset($args[$paramIndex])) {
                $preparedArgs[$paramIndex] = $args[$paramIndex];
            }

            if (isset($query[$param->getName()])) {
                $preparedArgs[$paramIndex] = $query[$param->getName()];
            }

            if (isset($content[$param->getName()])) {
                $preparedArgs[$paramIndex] = $content[$param->getName()];
            }

            $paramIndex++;
        }

        return [$preparedArgs, $params];
    }

    /**
     * @param $preparedArgs
     *
     * @return array
     */
    private function sanitizeArgs($preparedArgs)
    {
        $args = [];

        foreach ($preparedArgs as $preparedArg) {
            $arg = $preparedArg;

            if (is_object($preparedArg)) {
                $arg = 'object';
            }

            if (is_object($preparedArg) && get_class($preparedArg)) {
                $arg = get_class($preparedArg);
            }

            $args[] = $arg;
        }

        return $args;
    }

}
