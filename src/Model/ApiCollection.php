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
 * Class ApiCollection.
 *
 * Stores a collection.
 */
class ApiCollection implements \Iterator, \ArrayAccess
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    protected $indexedContainer = [];

    /**
     * @var array
     */
    protected $hashedContainer = [];

    /**
     * @return array
     */
    public function getCollection()
    {
        return $this->indexedContainer;
    }

    /**
     * @param array $collection
     *
     * @return Collection
     */
    public function setCollection($collection)
    {
        $this->indexedContainer = $collection;

        foreach ($collection as $argModel) {
            $this->hashedContainer[$argModel->getName()] = $argModel;
        }

        return $this;
    }

    /**
     * Iterator.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->indexedContainer[$this->position];
    }

    /**
     * Iterator next.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Iterator key.
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Iterator valid.
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->indexedContainer[$this->position]);
    }

    /**
     * Iterator rewind.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * ArrayAccess Offset Exists.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->hashedContainer[$offset]);
    }

    /**
     * ArrayAccess Offset Get.
     *
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->hashedContainer[$offset]) ? $this->hashedContainer[$offset] : null;
    }

    /**
     * ArrayAccess Offset Set.
     *
     * @param mixed      $offset
     * @param ParamModel $argModel
     */
    public function offsetSet($offset, $argModel)
    {
        if (is_null($offset)) {
            $this->hashedContainer[$argModel->getName()] = $argModel;
            $this->indexedContainer[] = $argModel;

            return;
        }

        $this->hashedContainer[$offset] = $argModel;
        $this->indexedContainer[$offset] = $argModel;
    }

    /**
     * ArrayAccess Offset Unset.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->hashedContainer[$offset]);
        unset($this->indexedContainer[$offset]);
    }
}
