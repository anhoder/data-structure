<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/26 11:38 下午
 */

namespace Alan\Structure\Queue;

use Alan\Structure\LinkedList\LinkedList;

/**
 * Class Queue
 * @package Alan\Structure\Queue
 */
class Queue implements QueueInterface
{
    /**
     * @var LinkedList
     */
    private $items;

    /**
     * Queue constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Is queue empty?
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->items->getLength() == 0;
    }

    /**
     * Enqueue.
     * @param $data
     * @return bool
     */
    public function enqueue($data): bool
    {
        $this->items->add($data);

        return true;
    }

    /**
     * Dequeue.
     * @return mixed|void
     */
    public function dequeue()
    {
        if ($this->isEmpty()) return null;
        $firstIndex = 0;
        $data = $this->items->get($firstIndex);
        $this->items->remove($firstIndex);
        return $data;
    }

    /**
     * Reset.
     * @return mixed|void
     */
    public function reset()
    {
        if (is_null($this->items)) $this->items = new LinkedList();
        else $this->items->clear();
    }

    /**
     * Get length.
     * @return int
     */
    public function getLength(): int
    {
        return $this->items->getLength();
    }
}
