<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/26 11:52 下午
 */

namespace Alan\Structure\Queue;

interface QueueInterface
{
    /**
     * Is the queue empty.
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Data enqueue.
     * @param $data
     * @return bool
     */
    public function enqueue($data): bool;

    /**
     * Data dequeue.
     * @return mixed
     */
    public function dequeue();

    /**
     * Reset.
     * @return mixed
     */
    public function reset();
}
