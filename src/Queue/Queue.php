<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/26 11:38 下午
 */

namespace Alan\Structure\Queue;

/**
 * Class Queue
 * @package Alan\Structure\Queue
 */
class Queue implements QueueInterface
{
    /**
     * @var array
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
        return empty($this->items);
    }

    /**
     * Enqueue.
     * @param $data
     * @return bool
     */
    public function enqueue($data): bool
    {
        $this->items[] = $data;

        return true;
    }

    /**
     * Dequeue.
     * @return mixed|void
     */
    public function dequeue()
    {
        if ($this->isEmpty()) return null;
        return array_shift($this->items);
    }

    /**
     * Reset.
     * @return mixed|void
     */
    public function reset()
    {
        $this->items = [];
    }

    /**
     * Get length.
     * @return int
     */
    public function getLength(): int
    {
        return count($this->items);
    }
}
