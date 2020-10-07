<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 1:02 下午
 */

use Alan\Structure\Queue\Queue;
use PHPUnit\Framework\TestCase;

/**
 * Class QueueTest
 */
class QueueTest extends TestCase
{
    /**
     * @test test queue.
     * @covers \Alan\Structure\Queue\Queue::reset
     * @covers \Alan\Structure\Queue\Queue::isEmpty
     * @covers \Alan\Structure\Queue\Queue::dequeue
     * @covers \Alan\Structure\Queue\Queue::enqueue
     */
    public function testQueue()
    {
        $queue = new Queue();
        $this->assertEquals(true, $queue->isEmpty());
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $this->assertEquals(1, $queue->dequeue());
        $this->assertEquals(2, $queue->dequeue());
        $this->assertEquals(false, $queue->isEmpty());
        $queue->reset();
        $this->assertEquals(true, $queue->isEmpty());
    }
}
