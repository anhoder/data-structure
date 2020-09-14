<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 12:38 下午
 */

namespace Alan\Structure\Traits\LinkedList;

trait Data
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * Data constructor.
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get data.
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data.
     * @param mixed $data
     * @return true
     */
    public function setData($data)
    {
        $this->data = $data;
        return true;
    }

    /**
     * To string
     * @return string
     */
    public function __toString()
    {
        $className = static::class;
        return "{$className}{data: {$this->data}}";
    }
}
