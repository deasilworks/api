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

namespace deasilworks\API\Traits;

use JMS\Serializer\Context;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

/**
 * Serializable Trait.
 */
trait Serializable
{
    /**
     * @return string
     */
    public function toJson()
    {
        return $this->serialize();
    }

    /**
     * Serialize.
     *
     * @SuppressWarnings(StaticAccess)
     * Because DI does not make sense here.
     *
     * @param object|null $obj
     *
     * @return mixed|string
     */
    protected function serialize($obj = null)
    {
        $type = 'json';

        if (!$obj) {
            $obj = $this;
        }

        $context = new SerializationContext();

        $builder = SerializerBuilder::create();
        $builder
            ->configureListeners(function (EventDispatcher $dispatcher) {
                $dispatcher->addListener('serializer.pre_serialize',
                    function (PreSerializeEvent $event) {
                        $object = $event->getObject();

                        // check for a type of object that contains the methods
                        // getCollection and getValueClass. This comes from a
                        // CEF object type. However since CEF is not a requirement
                        // for API serialization we are only looking for the capability
                        // to handle an array of objects.
                        if (
                            is_object($object)
                            && method_exists($object, 'getCollection')
                            && method_exists($object, 'getValueClass')
                        ) {
                            $event->setType('EntityCollection');
                        }
                    }
                );
            })
            ->configureHandlers(function (HandlerRegistry $registry) {
                $collectionHandler = function (JsonSerializationVisitor $visitor, $obj, array $type, Context $context) {
                    $nav = $visitor->getNavigator();
                    if (count($obj->getCollection()) < 1) {
                        return true;
                    }

                    return $nav->accept($obj->getCollection(), ['name' => 'array'], $context);
                };

                // Entity Array Handler
                $registry->registerHandler(
                    'serialization',
                    'EntityCollection',
                    'json',
                    $collectionHandler);

                // DateTime Handler ISO 8601 date "yyyy-mm-dd'T'HH:mm:ssZ"
                $registry->registerHandler('serialization', 'DateTime', 'json',
                    function ($visitor, \DateTime $obj, array $type, Context $context) {
                        return $obj->format('c');
                    }
                );
            });

        $serializer = $builder->build();

        return $serializer->serialize($obj, $type, $context);
    }
}
