<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 1:02 下午
 */

use Alan\Structure\Stack\Stack;
use PHPUnit\Framework\TestCase;

/**
 * Class StackTest
 */
class StackTest extends TestCase
{
    /**
     * @test test queue.
     * @covers \Alan\Structure\Stack\Stack::reset
     * @covers \Alan\Structure\Stack\Stack::isEmpty
     * @covers \Alan\Structure\Stack\Stack::pop
     * @covers \Alan\Structure\Stack\Stack::push
     */
    public function testStack()
    {
        $queue = new Stack();
        $this->assertEquals(true, $queue->isEmpty());
        $queue->push(1);
        $queue->push(2);
        $queue->push(3);
        $this->assertEquals(3, $queue->pop());
        $this->assertEquals(2, $queue->pop());
        $this->assertEquals(false, $queue->isEmpty());
        $queue->reset();
        $this->assertEquals(true, $queue->isEmpty());
    }
}
