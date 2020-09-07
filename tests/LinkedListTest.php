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
     */
    public function testInsert()
    {
        $linkedList = new LinkedList();

        // Insert.
        $linkedList->insertNode(0, new Node('first'));
        $this->assertEquals('first', $linkedList->get(0));
        $this->assertEquals(1, $linkedList->getLength());

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
     */
    public function testAdd()
    {
        $linkedList = new LinkedList();

        // Add node.
        $linkedList->addNode($first = new Node('first'));
        $this->assertEquals($first, $linkedList->getNode($linkedList->getLength() - 1));
        $this->assertEquals(null, $linkedList->getNode(99));

    }
}
