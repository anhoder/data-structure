<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 12:49 下午
 */

namespace Alan\Structure\Stack;

/**
 * Class Stack
 * @package Alan\Structure\Stack
 */
class Stack implements StackInterface
{
    /**
     * @var array
     */
    protected $items;

    /**
     * Stack constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * @inheritDoc
     * @return mixed|void
     */
    public function reset()
    {
        $this->items = [];
    }

    /**
     * @inheritDoc
     * @param $data
     * @return mixed|void
     */
    public function push($data)
    {
        array_push($this->items, $data);
    }

    /**
     * @inheritDoc
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }
}
