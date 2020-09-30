<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/30 9:38 上午
 */

namespace Alan\Structure\HashTable;


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
    public function __construct(int $cap = 64)
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
        return $this->cursorBucket->getValue();
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        if (!is_null($this->cursorBucket)) $this->cursorBucket = $this->cursorBucket->getNext();

        if (is_null($this->cursorBucket) && $this->cursor < count($this->usedIndexes) - 1 ) {
            ++$this->cursor;
            $this->cursorBucket = $this->items[$this->usedIndexes[$this->cursor]];
        }
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->cursorBucket->getKey();
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->cursor != count($this->usedIndexes) - 1 || !is_null($this->cursorBucket);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->cursor = 0;
        $this->cursorBucket = $this->items[$this->usedIndexes[$this->cursor]] ?? null;
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
        if ($this->length > ($this->cap>>1) + $this->cap) $this->expand();

        $hashCode = $this->hash($key);
        $bucket = new Bucket($hashCode, $key, $data);
        return $this->setBucket($bucket);
    }

    /**
     * Set bucket.
     * @param Bucket $bucket
     * @return bool
     */
    public function setBucket(Bucket $bucket)
    {
        $index = $bucket->getHashCode() % $this->cap;
        ++$this->length;

        if (!isset($this->items[$index])) {
            $this->items[$index] = $bucket;
            $this->usedIndexes[] = $index;
            return true;
        }

        $preBucket = null;
        $curBucket = $this->items[$index];
        while ($curBucket) {
            if ($curBucket->getKey() == $bucket->getKey()) {
                $curBucket->setValue($bucket->getValue());
                return true;
            }

            $preBucket = $curBucket;
            $curBucket = $curBucket->getNext();
        }

        $preBucket->setNext($bucket);

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

                if (is_null($preBucket)) {
                    $this->items[$index] = $bucket->getNext();

                    if (is_null($this->items[$index])) array_splice($this->usedIndexes, $index, 1);

                } else $preBucket->setNext($bucket->getNext());

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
        $this->usedIndexes = [];
        $this->length = 0;
        $this->cursor = 0;
        $this->cursorBucket = null;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Expand cap and rebuild index.
     * @return mixed|void
     */
    public function expand()
    {
        $oldTable = clone $this;

        if ($this->cap < 1024) $this->cap *= 2;
        else $this->cap += ($this->cap >> 2);

        $this->reset();

        foreach ($oldTable as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Hash算法
     * @param string $key
     * @return int
     */
    abstract protected function hash(string $key): int;
}
