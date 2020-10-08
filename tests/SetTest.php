<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/8 12:22 上午
 */

use Alan\Structure\Set\Set;
use PHPUnit\Framework\TestCase;

/**
 * Class SetTest
 */
class SetTest extends TestCase
{
    /**
     * @test Test set.
     * @covers \Alan\Structure\Set\Set::exists
     * @covers \Alan\Structure\Set\Set::getLength
     * @covers \Alan\Structure\Set\Set::reset
     * @covers \Alan\Structure\Set\Set::remove
     * @covers \Alan\Structure\Set\Set::add
     * @covers \Alan\Structure\Set\Set::pop
     */
    public function testSet()
    {
        $set = new Set();
        $this->assertEquals(true, $set->isEmpty());
        $set->add(1);
        $set->add('test');
        $set->add('test2');
        $set->add('test');
        $this->assertEquals(3, $set->getLength());
        $this->assertEquals(true, $set->exists('test'));
        $this->assertEquals(true, $set->exists('test2'));
        $set->remove('test');
        $this->assertEquals(false, $set->exists('test'));

        $res = [];
        while (true) {
            $tmp = $set->pop();
            if ($tmp === false) break;
            $res[] = $tmp;
        }
        $this->assertCount(2, $res);
        $this->assertEquals(true, $set->isEmpty());

        $set->add(1);
        $set->reset();
        $this->assertEquals(true, $set->isEmpty());
    }
}
