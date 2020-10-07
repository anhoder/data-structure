<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 12:49 下午
 */

namespace Alan\Structure\Stack;

use Alan\Structure\LinkedList\LinkedList;

/**
 * Class Stack
 * @package Alan\Structure\Stack
 */
class Stack implements StackInterface
{
    /**
     * @var LinkedList
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
        return $this->items->getLength() == 0;
    }

    /**
     * @inheritDoc
     * @return mixed|void
     */
    public function reset()
    {
        if (is_null($this->items)) $this->items = new LinkedList();
        else $this->items->clear();
    }

    /**
     * @inheritDoc
     * @param $data
     * @return mixed|void
     */
    public function push($data)
    {
        $this->items->add($data);
    }

    /**
     * @inheritDoc
     * @return mixed
     */
    public function pop()
    {
        $lastIndex = $this->items->getLength() - 1;
        $data = $this->items->get($lastIndex);
        $this->items->remove($lastIndex);

        return $data;
    }
}
