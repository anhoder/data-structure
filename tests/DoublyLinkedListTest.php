<?php

use Alan\Structure\DoublyLinkedList\DoublyLinkedList;
use Alan\Structure\DoublyLinkedList\DoublyNode;
use Alan\Structure\Exception\CircularListException;
use PHPUnit\Framework\TestCase;

class DoublyLinkedListTest extends TestCase
{
    /**
     * @test test insert.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::insertNode
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::insert
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::get
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getNode
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getLength
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getHead
     */
    public function testInsert()
    {
        $list = new DoublyLinkedList();

        // Insert.
        $list->insertNode(0, $first = new DoublyNode('first'));
        $this->assertEquals('first', $list->get(0));
        $this->assertEquals(1, $list->getLength());
        $this->assertEquals($first, $list->getHead());
        $this->assertEquals($first, $list->getTail());

        // Out of bounds.
        $list->insertNode(2, new DoublyNode('no insert'));
        $this->assertEquals(null, $list->get(2));
        $this->assertEquals(1, $list->getLength());
        $this->assertEquals($first, $list->getTail());

        // Insert.
        $list->insertNode(1, $second = new DoublyNode('second'));
        $this->assertEquals('second', $list->get(1));
        $this->assertEquals(2, $list->getLength());
        $this->assertEquals($second, $list->getTail());

        // Insert data, out of bounds.
        $list->insert(10, 'no insert');
        $this->assertEquals(null, $list->get(10));
        $this->assertEquals(2, $list->getLength());
        $this->assertEquals('second', $list->getTail()->getData());

        // Insert data.
        $list->insert(2, 'third');
        $this->assertEquals('third', $list->get(2));
        $this->assertEquals(3, $list->getLength());
        $this->assertEquals('third', $list->getTail()->getData());

        // Get node.
        $this->assertEquals($second, $list->getNode(1));
        $this->assertEquals(null, $list->getNode(10));

        // Insert to first.
        $list->insert(0, 'now first');
        $this->assertEquals('now first', $list->get(0));
    }

    /**
     * @test test add.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::addNode
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::add
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::get
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getNode
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getLength
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getHead
     */
    public function testAdd()
    {
        $linkedList = new DoublyLinkedList();

        $this->assertEquals(0, $linkedList->getLength());

        // Add node.
        $linkedList->addNode($first = new DoublyNode('first'));
        $this->assertEquals($first, $linkedList->getNode($linkedList->getLength() - 1));
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->getNode(99));
        $this->assertEquals($first, $linkedList->getHead());
        $this->assertEquals($first, $linkedList->getTail());


        // Add.
        $linkedList->add('seconds');
        $this->assertEquals('seconds', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->get(99));
        $this->assertEquals('seconds', $linkedList->getTail()->getData());
    }

    /**
     * @test Test set node.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::setNode
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::set
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::get
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::count
     * @throws CircularListException
     */
    public function testSet()
    {
        $linkedList = new DoublyLinkedList();

        // set head
        $first = new DoublyNode('first');
        $linkedList->setNode(0, $first);
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals($first, $linkedList->getHead());
        $this->assertEquals($first, $linkedList->getNode(0));
        $this->assertEquals('first', $linkedList->getTail()->getData());

        // no set
        $noSet = new DoublyNode('no set');
        $linkedList->setNode(2, $noSet);
        $this->assertEquals(1, $linkedList->getLength());

        // replace
        $replace = new DoublyNode('replace');
        $replace->setNext(new DoublyNode('next'));
        $replace->getNext()->setNext(new DoublyNode('next2'));
        $linkedList->setNode(0, $replace);
        $this->assertEquals(3, DoublyNode::count($replace));
        $this->assertEquals(3, $linkedList->getLength());
        $this->assertEquals('next2', $linkedList->getTail()->getData());

        // replace 2
        $replace2 = new DoublyNode('replace2');
        $linkedList->setNode(1, $replace2);
        $this->assertEquals('replace2', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals('replace2', $linkedList->getTail()->getData());

        // set data.
        $linkedList->set(1, 'replace3');
        $this->assertEquals('replace3', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals('replace3', $linkedList->getTail()->getData());
    }

    /**
     * @test Test remove.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::remove
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::removeNode
     */
    public function testRemove()
    {
        $linkedList = new DoublyLinkedList();

        $linkedList->add('first')->add('second')->add('third');
        $this->assertEquals(3, $linkedList->getLength());
        $this->assertEquals('third', $linkedList->getTail()->getData());

        // Remove.
        $linkedList->remove(1);
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals('first', $linkedList->get(0));
        $this->assertEquals('third', $linkedList->get(1));
        $this->assertEquals('third', $linkedList->getTail()->getData());

        // Remove node.
        $linkedList->removeNode(0);
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals('third', $linkedList->get(0));
        $this->assertEquals(null, $linkedList->get(1));
        $this->assertEquals('third', $linkedList->getTail()->getData());

        $linkedList->removeNode(0);
        $this->assertEquals(null, $linkedList->getTail());
    }

    /**
     * @test Test clear.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::clear
     */
    public function testClear()
    {
        $linkedList = new DoublyLinkedList();

        $linkedList->add('first')->add('second')->add('third');
        $this->assertEquals(3, $linkedList->getLength());

        $linkedList->clear();
        $this->assertEquals(0, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->get(0));
        $this->assertEquals(null, $linkedList->getHead());
        $this->assertEquals(null, $linkedList->getTail());
    }

    /**
     * @test Test hasCircle method.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::hasCircle
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::count
     */
    public function testHasCircle()
    {
        // Dont has circle.
        $first = new DoublyNode('first');
        $this->assertEquals(false, DoublyNode::hasCircle($first));

        // Has circle.
        $second = new DoublyNode('second');
        $third = new DoublyNode('third');
        $first->setNext($second);
        $second->setNext($third);
        $third->setNext($first);
        $this->assertEquals(true, DoublyNode::hasCircle($first));

        $this->expectException(CircularListException::class);
        DoublyNode::count($first);
    }

    /**
     * @test Test array access.
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::offsetExists
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::offsetGet
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::offsetSet
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::offsetUnset
     */
    public function testArrayAccess()
    {
        $linkedList = new DoublyLinkedList();
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
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::current
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::key
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::next
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::rewind
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::valid
     */
    public function testIterator()
    {
        $linkedList = new DoublyLinkedList();
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

    /**
     * @test
     * @covers \Alan\Structure\DoublyLinkedList\DoublyLinkedList::getTail
     * @covers \Alan\Structure\DoublyLinkedList\DoublyNode::getPrev
     */
    public function testReverse()
    {
        $list = new DoublyLinkedList();
        $list->add('first')->add('second')->add('third');

        $this->assertEquals('third', $list->getTail()->getData());
        $this->assertEquals('second', $list->getTail()->getPrev()->getData());
        $this->assertEquals('first', $list->getTail()->getPrev()->getPrev()->getData());
    }
}
