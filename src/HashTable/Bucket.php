<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/30 9:49 上午
 */

namespace Alan\Structure\HashTable;

class Bucket
{
    /**
     * @var string
     */
    protected $hashCode;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var Bucket
     */
    protected $next;

    /**
     * Bucket constructor.
     * @param string $hashCode
     * @param string $key
     * @param mixed $value
     */
    public function __construct(string $hashCode, string $key, $value)
    {
        $this->hashCode = $hashCode;
        $this->key = $key;
        $this->value = $value;
    }


    /**
     * @return string
     */
    public function getHashCode(): string
    {
        return $this->hashCode;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return Bucket
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param Bucket $next
     */
    public function setNext(Bucket $next)
    {
        $this->next = $next;
    }
}
