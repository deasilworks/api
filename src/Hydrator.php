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
 * Class ControllerAction.
 *
 * Responsible for taking a class based oject and
 * calling it's setters with matching params from a
 * standard object.
 *
 * The purpose of the hydrator is setting properties
 * of models with setters. Model setters should only
 * contain one parameter.
 *
 * Model setters can accept a scaler or type hinted
 * class. Values for setters without type hints are passed
 * as compound types or scalers.
 */
class Hydrator
{
    /**
     * Hydrating a class object from a hashed array
     * uses an **Adder**. addSomething().
     */
    const PREFIX_ADDER = 'add';

    /**
     * Hydrating a class object from standard object
     * calls a **Setter** for each of it's properties.
     * setSomething().
     */
    const PREFIX_SETTER = 'set';

    /**
     * Hydrate Object.
     *
     * Takes an object and tries to hydrate it with another.
     *
     * Uses methods prefixed with "set" to set values.
     *
     * If the payload is an array (hash) it will call a method
     * prefixed with "add". This is required in order to find
     * the type hint.
     *
     * @param object       $targetObject
     * @param object|array $payload
     *
     * @return object
     */
    public function hydrateObject($targetObject, $payload)
    {
        foreach ($payload as $param => $value) {
            if (is_int($param)) {
                foreach ($value as $par => $val) {
                    $setter = $this->prefixer(self::PREFIX_ADDER, $par);
                    $this->hydrateMethod($targetObject, $setter, $val);
                }
                continue;
            }

            $setter = $this->prefixer(self::PREFIX_SETTER, $param);

            $this->hydrateMethod($targetObject, $setter, $value);
        }

        return $targetObject;
    }

    /**
     * Hydrate Method.
     *
     * Checks the method signature for a type hint, if
     * one is found hydrate is called and the result is
     * sent to the method.
     *
     * If there is no type hint in the method signature
     * the value is used without attempting hydration.
     *
     * @param $targetObject
     * @param $method
     * @param $value
     */
    protected function hydrateMethod($targetObject, $method, $value)
    {
        if (method_exists($targetObject, $method)) {
            $dryObject = $this->getParameterClassObject($targetObject, $method);

            if ($dryObject && is_object($dryObject)) {
                $hydratedObject = $this->hydrateObject($dryObject, $value);
                $targetObject->$method($hydratedObject);

                return;
            }

            $targetObject->$method($value);
        }
    }

    /**
     * Get Parameter Class Object.
     *
     * Get the Class of object a method requires.
     *
     * @param $object
     * @param $method
     *
     * @return mixed
     */
    public function getParameterClassObject($object, $method)
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $parameters = $reflectionClass->getMethod($method)->getParameters();

        if ($parameters && isset($parameters[0])) {
            $refClass = $parameters[0]->getClass();

            if ($refClass) {
                $class = $refClass->getName();

                return new $class();
            }
        }
    }

    /**
     * Snake to Pascal.
     *
     * Converts a_snake_case_string to aPascalCaseString.
     *
     * @param $input
     *
     * @return string
     */
    public function snakeToPascal($input)
    {
        return str_replace('_', '', ucwords($input, '_'));
    }

    /**
     * Prefixer.
     *
     * @param $prefix
     * @param $method
     *
     * @return string
     */
    private function prefixer($prefix, $method)
    {
        return $prefix.$this->snakeToPascal($method);
    }
}
