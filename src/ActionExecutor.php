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

use deasilworks\API\Model\Action\ActionModel;
use deasilworks\API\Model\ActionResponseModel;
use deasilworks\API\Model\ParamModel;
use deasilworks\API\Model\RestRequestModel;


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
     * @param RestRequestModel $apiRequest
     * @param $action
     * @param $indexedArgs
     *
     * @throws \Exception
     *
     * @return $response
     */
    public function execute(RestRequestModel $apiRequest, $action, $indexedArgs)
    {
        $actionReader = $this->actionReader;
        $response = new ActionResponseModel();

        $actionCollection = $actionReader->getActionCollection();

        /* @var ActionModel $targetAction */
        if (!isset($actionCollection[$action][$apiRequest->getMethod()])) {
            throw new \Exception('Method '.$apiRequest->getMethod().' not supported by '.$action.' action.');
        }

        $targetAction = $actionCollection[$action][$apiRequest->getMethod()];

        if (!isset($targetAction)) {
            throw new \Exception('Unknown action "'.$action.'" for this controller.');
        }

        $query = [];
        parse_str($apiRequest->getQueryString(), $query);

        $content = $this->contentParser($apiRequest);

        // array of hashed based args
        $searchHashedArgs = [$query, $content];

        // get a hash of paramName => value ($preparedArgs), and a list of the params
        list($preparedArgs, $params) = $this->prepareArgs($targetAction, $indexedArgs, $searchHashedArgs);

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
     * @param RestRequestModel $apiRequest
     *
     * @return mixed
     */
    private function contentParser(RestRequestModel $apiRequest)
    {
        $content = [];

        if ($apiRequest->getContentType() == 'form') {
            parse_str($apiRequest->getContent(), $content);
        }

        if (in_array($apiRequest->getContentType(),['json','js'])) {

            $content = json_decode($apiRequest->getContent());

            // @TODO: check for PkgModel style object to pull out payload


        }

        return $content;
    }

    /**
     * Prepare Args.
     *
     * Takes a $targetAction to determine parameters.
     *
     * Takes an array of $indexedArgs and attempts to populate
     * the parameters with them.
     *
     * Takes an array of hashes ($searchHashedArgs = [$query, $content])
     * to look for any keys that match the actions parameters.
     *
     * @param ActionModel $targetAction
     * @param array       $indexedArgs      indexed array of args
     * @param array       $searchHashedArgs array of hashes to search
     *
     * @return array
     */
    private function prepareArgs(ActionModel $targetAction, $indexedArgs, $searchHashedArgs)
    {
        $preparedArgs = [];
        $paramIndex = 0;
        $params = [];

        /** @var ParamModel $param */
        foreach ($targetAction->getParamCollection() as $param) {

            $params[$paramIndex] = $param;

            $paramName = $param->getName();

            if (isset($indexedArgs[$paramIndex])) {
                $preparedArgs[$paramIndex] = $indexedArgs[$paramIndex];
            }

            foreach ($searchHashedArgs as $searchHashedArg) {

                if (is_object($searchHashedArg) && $searchHashedArg->$paramName) {

                    $paramClass = $param->getType();

                    if ($paramClass) {
                        $dryObject = new $paramClass();

                        $hydrator = new Hydrator();
                        $hydratedObj = $hydrator->hydrateObject($dryObject, $searchHashedArg->$paramName);

                        $preparedArgs[$paramIndex] = $hydratedObj;
                        continue;
                    }

                    $preparedArgs[$paramIndex] = $searchHashedArg->$paramName;
                    continue;
                }

                if (isset($searchHashedArg[$paramName])) {
                    $preparedArgs[$paramIndex] = $searchHashedArg[$paramName];
                }
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
