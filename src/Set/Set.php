<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 10:42 下午
 */

namespace Alan\Structure\Set;

use Alan\Structure\HashTable\HashTable;
use Alan\Structure\HashTable\Times33HashTable;

/**
 * Class Set
 * @package Alan\Structure\Set
 */
class Set implements SetInterface
{
    /**
     * @var HashTable
     */
    protected $hashTable;

    /**
     * Set constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * @inheritDoc
     */
    public function exists(string $data): bool
    {
        return isset($this->hashTable[$data]);
    }

    /**
     * @inheritDoc
     */
    public function add(string $data): bool
    {
        if ($this->exists($data)) return false;
        $this->hashTable[$data] = $data;
        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $data): bool
    {
        if (!$this->exists($data)) return false;
        $this->hashTable->remove($data);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getLength(): int
    {
        return $this->hashTable->getLength();
    }

    /**
     * @inheritDoc
     */
    public function pop()
    {
        $key = $this->hashTable->randomKey();
        if (is_null($key)) return false;
        $data = $this->hashTable[$key];
        $this->hashTable->remove($key);
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        if (is_null($this->hashTable)) $this->hashTable = new Times33HashTable();
        else $this->hashTable->reset();
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->getLength() == 0;
    }
}
