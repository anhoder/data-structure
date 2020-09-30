<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/30 9:38 上午
 */

namespace Alan\Structure\Hash;


abstract class HashTable implements HashTableInterface
{
    /**
     * Current index.
     * @var int
     */
    protected $cursor;

    /**
     * Current bucket.
     * @var Bucket
     */
    protected $cursorBucket;

    /**
     * Content.
     * @var Bucket[]
     */
    protected $items;

    /**
     * @var int[]
     */
    protected $usedIndexes;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var int
     */
    protected $cap;

    /**
     * HashTable constructor.
     * @param int $cap
     */
    public function __construct(int $cap)
    {
        $this->length = 0;
        $this->cursor = 0;
        $this->cap = $cap;
    }


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
        ++$this->cursor;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {

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
        return $this->has((string)$offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get((string)$offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        return $this->set((string)$offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        return $this->remove((string)$offset);
    }

    /**
     * Get bucket by key.
     * @param string $key
     * @return Bucket|null
     */
    protected function getBucket(string $key)
    {
        $index = $this->hash($key) % $this->cap;
        if (!isset($this->items[$index])) return null;

        $bucket = $this->items[$index];
        while ($bucket) {
            if ($bucket->getKey() == $key) return $bucket;

            $bucket = $bucket->getNext();
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function has(string $key)
    {
        $bucket = $this->getBucket($key);
        if (is_null($bucket)) return false;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        $bucket = $this->getBucket($key);
        if (is_null($bucket)) return null;

        return $bucket->getValue();
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $data)
    {
        $hashCode = $this->hash($key);
        $index = $hashCode % $this->cap;
        ++$this->length;

        if (!isset($this->items[$index])) {
            $this->items[$index] = new Bucket($hashCode, $key, $data);
            $this->usedIndexes[] = $index;
            return true;
        }

        $bucket = $this->items[$index];
        while ($bucket) {
            if ($bucket->getKey() == $key) {
                $bucket->setValue($data);
                return true;
            }

            $bucket = $bucket->getNext();
        }

        $bucket->setNext(new Bucket($hashCode, $key, $data));

        return true;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->length == 0;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $key)
    {
        $index = $this->hash($key) % $this->cap;

        if (!isset($this->items[$index])) return false;

        $bucket = $this->items[$index];
        /**
         * @var Bucket|null $preBucket
         */
        $preBucket = null;
        while ($bucket) {

            if ($bucket->getKey() == $key) {

                if (is_null($preBucket)) $this->items[$index] = $bucket->getNext();
                else $preBucket->setNext($bucket->getNext());

                unset($bucket);
                --$this->length;

                return true;
            }

            $preBucket = $bucket;
            $bucket = $bucket->getNext();
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        $this->items = [];
        $this->length = 0;
    }

    /**
     * Hash算法
     * @param string $key
     * @return int
     */
    abstract public function hash(string $key): int;
}
