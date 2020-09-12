<?php

use Alan\Structure\LinkedList\LinkedList;
use Alan\Structure\LinkedList\Node;
use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase
{
    /**
     * @test test insert.
     * @covers \Alan\Structure\LinkedList\LinkedList::insertNode
     * @covers \Alan\Structure\LinkedList\LinkedList::insert
     * @covers \Alan\Structure\LinkedList\LinkedList::get
     * @covers \Alan\Structure\LinkedList\LinkedList::getNode
     * @covers \Alan\Structure\LinkedList\LinkedList::getLength
     * @covers \Alan\Structure\LinkedList\LinkedList::getHead
     */
    public function testInsert()
    {
        $linkedList = new LinkedList();

        // Insert.
        $linkedList->insertNode(0, $first = new Node('first'));
        $this->assertEquals('first', $linkedList->get(0));
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals($first, $linkedList->getHead());

        // Out of bounds.
        $linkedList->insertNode(2, new Node('no insert'));
        $this->assertEquals(null, $linkedList->get(2));
        $this->assertEquals(1, $linkedList->getLength());

        // Insert.
        $linkedList->insertNode(1, $second = new Node('second'));
        $this->assertEquals('second', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());

        // Insert data, out of bounds.
        $linkedList->insert(10, 'no insert');
        $this->assertEquals(null, $linkedList->get(10));
        $this->assertEquals(2, $linkedList->getLength());

        // Insert data.
        $linkedList->insert(2, 'third');
        $this->assertEquals('third', $linkedList->get(2));
        $this->assertEquals(3, $linkedList->getLength());

        // Get node.
        $this->assertEquals($second, $linkedList->getNode(1));
        $this->assertEquals(null, $linkedList->getNode(10));


    }

    /**
     * @test test add.
     * @covers \Alan\Structure\LinkedList\LinkedList::addNode
     * @covers \Alan\Structure\LinkedList\LinkedList::add
     * @covers \Alan\Structure\LinkedList\LinkedList::get
     * @covers \Alan\Structure\LinkedList\LinkedList::getNode
     * @covers \Alan\Structure\LinkedList\LinkedList::getLength
     * @covers \Alan\Structure\LinkedList\LinkedList::getHead
     */
    public function testAdd()
    {
        $linkedList = new LinkedList();

        $this->assertEquals(0, $linkedList->getLength());

        // Add node.
        $linkedList->addNode($first = new Node('first'));
        $this->assertEquals($first, $linkedList->getNode($linkedList->getLength() - 1));
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->getNode(99));
        $this->assertEquals($first, $linkedList->getHead());


        // Add.
        $linkedList->add('seconds');
        $this->assertEquals('seconds', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->get(99));
    }

    /**
     * @test Test set node.
     * @covers \Alan\Structure\LinkedList\LinkedList::setNode
     * @covers \Alan\Structure\LinkedList\LinkedList::set
     * @covers \Alan\Structure\LinkedList\LinkedList::get
     * @covers \Alan\Structure\LinkedList\LinkedList::count
     */
    public function testSet()
    {
        $linkedList = new LinkedList();

        // set head
        $first = new Node('first');
        $linkedList->setNode(0, $first);
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals($first, $linkedList->getHead());
        $this->assertEquals($first, $linkedList->getNode(0));

        // no set
        $noSet = new Node('no set');
        $linkedList->setNode(2, $noSet);
        $this->assertEquals(1, $linkedList->getLength());

        // replace
        $replace = new Node('replace');
        $replace->setNext(new Node('next'));
        $replace->getNext()->setNext(new Node('next2'));
        $linkedList->setNode(0, $replace);
        $this->assertEquals(3, LinkedList::count($replace));
        $this->assertEquals(3, $linkedList->getLength());

        // replace 2
        $replace2 = new Node('replace2');
        $linkedList->setNode(1, $replace2);
        $this->assertEquals('replace2', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());

        // set data.
        $linkedList->set(1, 'replace3');
        $this->assertEquals('replace3', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());
    }

    /**
     * @test Test remove.
     * @covers \Alan\Structure\LinkedList\LinkedList::remove
     * @covers \Alan\Structure\LinkedList\LinkedList::removeNode
     */
    public function testRemove()
    {
        $linkedList = new LinkedList();

        $linkedList->add('first')->add('second')->add('third');
        $this->assertEquals(3, $linkedList->getLength());

        // Remove.
        $linkedList->remove(1);
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals('first', $linkedList->get(0));
        $this->assertEquals('third', $linkedList->get(1));

        // Remove node.
        $linkedList->removeNode(0);
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals('third', $linkedList->get(0));
        $this->assertEquals(null, $linkedList->get(1));
    }

    /**
     * @test Test clear.
     * @covers \Alan\Structure\LinkedList\LinkedList::clear
     */
    public function testClear()
    {
        $linkedList = new LinkedList();

        $linkedList->add('first')->add('second')->add('third');
        $this->assertEquals(3, $linkedList->getLength());

        $linkedList->clear();
        $this->assertEquals(0, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->get(0));
    }

    /**
     * @test Test array access.
     * @covers \Alan\Structure\LinkedList\LinkedList::offsetExists
     * @covers \Alan\Structure\LinkedList\LinkedList::offsetGet
     * @covers \Alan\Structure\LinkedList\LinkedList::offsetSet
     * @covers \Alan\Structure\LinkedList\LinkedList::offsetUnset
     */
    public function testArrayAccess()
    {
        $linkedList = new LinkedList();
        $linkedList[0] = 'first';
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals('first', $linkedList[0]);

        $linkedList[2] = 'no data';
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals(null, $linkedList[2]);

        $linkedList[1] = 'second';
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals('second', $linkedList[1]);
    }

    /**
     * @test Test iterator.
     * @covers \Alan\Structure\LinkedList\LinkedList::current
     * @covers \Alan\Structure\LinkedList\LinkedList::key
     * @covers \Alan\Structure\LinkedList\LinkedList::next
     * @covers \Alan\Structure\LinkedList\LinkedList::rewind
     * @covers \Alan\Structure\LinkedList\LinkedList::valid
     */
    public function testIterator()
    {
        $linkedList = new LinkedList();
        $linkedList->add('first')->add('second')->add('third')->add('fourth');

        $expect = [
            'first',
            'second',
            'third',
            'fourth',
        ];
        $i = 0;
        foreach ($linkedList as $i => $item) {
            $this->assertEquals($expect[$i], $item);
        }
        $this->assertEquals($i + 1, $linkedList->getLength());
    }
}
