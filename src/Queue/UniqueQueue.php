<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/8 12:02 下午
 */

namespace Alan\Structure\Queue;

use Alan\Structure\Set\Set;
use Alan\Structure\Set\SetInterface;

class UniqueQueue implements QueueInterface
{
    /**
     * @var SetInterface
     */
    protected $set;

    /**
     * @var Queue
     */
    protected $queue;

    /**
     * UniqueQueue constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->queue->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function enqueue($data): bool
    {
        if ($this->set->exists((string)$data)) return false;

        $this->set->add((string)$data);
        $this->queue->enqueue($data);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function dequeue()
    {
        $data = $this->queue->dequeue();
        $this->set->remove((string)$data);

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        if (is_null($this->set)) $this->set = new Set();
        else $this->set->reset();

        if (is_null($this->queue)) $this->queue = new Queue();
        else $this->queue->reset();
    }

    /**
     * @inheritDoc
     */
    public function getLength(): int
    {
        return $this->queue->getLength();
    }
}
