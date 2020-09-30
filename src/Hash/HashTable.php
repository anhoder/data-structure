<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/30 9:38 上午
 */

namespace Alan\Structure\Hash;

use Alan\Structure\LinkedList\Node;

abstract class HashTable implements HashTableInterface
{
    /**
     * Current key.
     * @var string
     */
    protected $cursor;

    /**
     * Content
     * @var Bucket[]
     */
    protected $items;

    /**
     * @inheritDoc
     */
    public function current()
    {

    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    /**
     * @inheritDoc
     */
    public function has(string $key)
    {
        $index = $this->hash($key);
        return isset($this->items[$index]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        $index = $this->hash($key);
        if (!isset($this->items[$index])) return null;

        $bucket = $this->items[$index];
        while ($bucket) {
            if ($bucket->getKey() == $key) return $bucket->getValue();

            $bucket = $bucket->getNextBucket();
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $data)
    {

    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        // TODO: Implement isEmpty() method.
    }

    /**
     * @inheritDoc
     */
    public function remove($key)
    {
        // TODO: Implement remove() method.
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        // TODO: Implement reset() method.
    }

    /**
     * Hash算法
     * @param string $key
     * @return int
     */
    abstract public function hash(string $key): int;
}
