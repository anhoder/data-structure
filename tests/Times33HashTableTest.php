<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/30 5:17 下午
 */

use Alan\Structure\HashTable\Times33HashTable;
use PHPUnit\Framework\TestCase;

class Times33HashTableTest extends TestCase
{
    /**
     * @test Test hash table set.
     */
    public function testSet()
    {
        $hash = new Times33HashTable();
        $hash->set('name', 'Alan');

    }

    public function testGet()
    {

    }

    public function testHas()
    {

    }

    public function testIsEmpty()
    {

    }

    public function testRemove()
    {

    }

    public function testReset()
    {

    }

    public function testArrayAccess()
    {

    }

    public function testIterable()
    {

    }
}
