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
     * @covers \Alan\Structure\HashTable\Times33HashTable::set
     * @covers \Alan\Structure\HashTable\Times33HashTable::get
     * @covers \Alan\Structure\HashTable\Times33HashTable::getLength
     */
    public function testSet()
    {
        $hash = new Times33HashTable();
        $hash->set('stu1', 'Alan');
        $hash->set('stu2', 'Jane');
        $this->assertEquals(2, $hash->getLength());
        $this->assertEquals('Alan', $hash->get('stu1'));
        $this->assertEquals('Jane', $hash->get('stu2'));
        $hash->set('stu2', 'Anhoder');
        $this->assertEquals('Anhoder', $hash->get('stu2'));
    }

    /**
     * @test Test hash table has key.
     * @covers \Alan\Structure\HashTable\Times33HashTable::has
     */
    public function testHas()
    {
        $hash = new Times33HashTable();
        $hash->set('exists', true);
        $this->assertEquals(true, $hash->has('exists'));
        $this->assertEquals(false, $hash->has('not exists'));
    }

    /**
     * @test Test hash table is empty.
     * @covers \Alan\Structure\HashTable\Times33HashTable::isEmpty
     */
    public function testIsEmpty()
    {
        $hash = new Times33HashTable();
        $this->assertEquals(true, $hash->isEmpty());
        $hash->set('name', 'Alan');
        $this->assertEquals(false, $hash->isEmpty());
    }

    /**
     * @test Test remove.
     * @covers \Alan\Structure\HashTable\Times33HashTable::remove
     * @covers \Alan\Structure\HashTable\Times33HashTable::set
     */
    public function testRemove()
    {
        $hash = new Times33HashTable();
        $hash->set('stu1', 'Alan');
        $hash->set('stu2', 'Jane');
        $this->assertEquals(2, $hash->getLength());
        $hash->remove('stu1');
        $this->assertEquals(1, $hash->getLength());
        $this->assertEquals('Jane', $hash->get('stu2'));
    }

    /**
     * @test Test reset.
     * @covers \Alan\Structure\HashTable\Times33HashTable::set
     * @covers \Alan\Structure\HashTable\Times33HashTable::reset
     */
    public function testReset()
    {
        $hash = new Times33HashTable();
        $hash->set('stu1', 'Alan');
        $hash->set('stu2', 'Jane');
        $this->assertEquals(2, $hash->getLength());
        $hash->reset();
        $this->assertEquals(0, $hash->getLength());
    }

    /**
     * @test Access hash table with array.
     * @covers \Alan\Structure\HashTable\Times33HashTable::offsetExists
     * @covers \Alan\Structure\HashTable\Times33HashTable::offsetGet
     * @covers \Alan\Structure\HashTable\Times33HashTable::offsetSet
     * @covers \Alan\Structure\HashTable\Times33HashTable::offsetUnset
     */
    public function testArrayAccess()
    {
        $hash = new Times33HashTable();
        $hash['stu1'] = 'Alan';
        $hash['stu2'] = 'Jane';
        $this->assertEquals('Alan', $hash['stu1']);
        $this->assertEquals('Jane', $hash['stu2']);
        $this->assertEquals(2, $hash->getLength());
    }

    /**
     * @test Test iterable.
     * @covers \Alan\Structure\HashTable\Times33HashTable::rewind
     * @covers \Alan\Structure\HashTable\Times33HashTable::current
     * @covers \Alan\Structure\HashTable\Times33HashTable::next
     * @covers \Alan\Structure\HashTable\Times33HashTable::valid
     * @covers \Alan\Structure\HashTable\Times33HashTable::key
     */
    public function testIterable()
    {
        $hash = new Times33HashTable();
        for ($i = 0; $i < 100; ++$i) {
            $hash["stu{$i}"] = $i;
        }

        foreach ($hash as $k => $v) {
            $this->assertEquals("stu{$v}", $k);
        }
    }
}
