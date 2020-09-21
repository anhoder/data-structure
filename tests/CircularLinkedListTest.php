<?php

use Alan\Structure\CircularLinkedList\CircularLinkedList;
use Alan\Structure\DoublyLinkedList\DoublyLinkedList;
use Alan\Structure\DoublyLinkedList\DoublyNode;
use Alan\Structure\Exception\CircularListException;
use PHPUnit\Framework\TestCase;

class CircularLinkedListTest extends TestCase
{
    /**
     * @test test insert.
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::insertNode
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::insert
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::get
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getNode
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getLength
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getHead
     */
    public function testInsert()
    {
        $list = new CircularLinkedList();

        // Insert.
        $list->insertNode(0, $first = new DoublyNode('first'));
        $this->assertEquals('first', $list->get(0));
        $this->assertEquals(1, $list->getLength());
        $this->assertEquals($first, $list->getHead());
        $this->assertEquals($first, $list->getTail());
        $this->assertEquals($first, $list->getTail()->getNext());
        $this->assertEquals($first, $list->getHead()->getPrev());

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
        $this->assertEquals($first, $list->getTail()->getNext());
        $this->assertEquals($second, $list->getHead()->getPrev());

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
        $this->assertEquals('first', $list->getTail()->getNext()->getData());
        $this->assertEquals('third', $list->getHead()->getPrev()->getData());

        // Get node.
        $this->assertEquals($second->getData(), $list->getNode(1)->getData());
        $this->assertEquals(null, $list->getNode(10));

        // Insert to first.
        $list->insert(0, 'now first');
        $this->assertEquals('now first', $list->get(0));
        $this->assertEquals('now first', $list->getTail()->getNext()->getData());
        $this->assertEquals('third', $list->getHead()->getPrev()->getData());
    }

    /**
     * @test test add.
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::addNode
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::add
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::get
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getNode
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getLength
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getHead
     */
    public function testAdd()
    {
        $linkedList = new CircularLinkedList();

        $this->assertEquals(0, $linkedList->getLength());

        // Add node.
        $linkedList->addNode($first = new DoublyNode('first'));
        $this->assertEquals($first, $linkedList->getNode($linkedList->getLength() - 1));
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->getNode(99));
        $this->assertEquals($first, $linkedList->getHead());
        $this->assertEquals($first, $linkedList->getTail());
        $this->assertEquals($first, $linkedList->getTail()->getNext());
        $this->assertEquals($first, $linkedList->getHead()->getPrev());


        // Add.
        $linkedList->add('seconds');
        $this->assertEquals('seconds', $linkedList->get(1));
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->get(99));
        $this->assertEquals('seconds', $linkedList->getTail()->getData());
        $this->assertEquals('first', $linkedList->getTail()->getNext()->getData());
        $this->assertEquals('seconds', $linkedList->getHead()->getPrev()->getData());
    }

    /**
     * @test Test set node.
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::set
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::get
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::count
     */
    public function testSet()
    {
        $linkedList = new CircularLinkedList();

        // set data.
        $linkedList->set(0, 'replace3');
        $this->assertEquals('replace3', $linkedList->get(1));
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals('replace3', $linkedList->getTail()->getData());
        $this->assertEquals('replace3', $linkedList->getTail()->getNext()->getData());
        $this->assertEquals('replace3', $linkedList->getHead()->getPrev()->getData());
    }

    /**
     * @test Test remove.
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::remove
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::removeNode
     */
    public function testRemove()
    {
        $linkedList = new CircularLinkedList();

        $linkedList->add('first')->add('second')->add('third');
        $this->assertEquals(3, $linkedList->getLength());
        $this->assertEquals('third', $linkedList->getTail()->getData());
        $this->assertEquals('first', $linkedList->getTail()->getNext()->getData());
        $this->assertEquals('third', $linkedList->getHead()->getPrev()->getData());

        // Remove.
        $linkedList->remove(1);
        $this->assertEquals(2, $linkedList->getLength());
        $this->assertEquals('first', $linkedList->get(0));
        $this->assertEquals('third', $linkedList->get(1));
        $this->assertEquals('third', $linkedList->getTail()->getData());
        $this->assertEquals('first', $linkedList->getTail()->getNext()->getData());
        $this->assertEquals('third', $linkedList->getHead()->getPrev()->getData());

        // Remove node.
        $linkedList->removeNode(0);
        $this->assertEquals(1, $linkedList->getLength());
        $this->assertEquals('third', $linkedList->get(0));
        $this->assertEquals(null, $linkedList->get(1));
        $this->assertEquals('third', $linkedList->getTail()->getData());
        $this->assertEquals('third', $linkedList->getTail()->getNext()->getData());
        $this->assertEquals('third', $linkedList->getHead()->getPrev()->getData());

        $linkedList->removeNode(0);
        $this->assertEquals(null, $linkedList->getTail());
    }

    /**
     * @test Test clear.
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::clear
     */
    public function testClear()
    {
        $linkedList = new CircularLinkedList();

        $linkedList->add('first')->add('second')->add('third');
        $this->assertEquals(3, $linkedList->getLength());

        $linkedList->clear();
        $this->assertEquals(0, $linkedList->getLength());
        $this->assertEquals(null, $linkedList->get(0));
        $this->assertEquals(null, $linkedList->getHead());
        $this->assertEquals(null, $linkedList->getTail());
    }

    /**
     * @test Test array access.
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::offsetExists
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::offsetGet
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::offsetSet
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::offsetUnset
     */
    public function testArrayAccess()
    {
        $linkedList = new CircularLinkedList();
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
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::current
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::key
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::next
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::rewind
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::valid
     */
    public function testIterator()
    {
        $linkedList = new CircularLinkedList();
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
     * @covers \Alan\Structure\CircularLinkedList\CircularLinkedList::getTail
     * @covers \Alan\Structure\DoublyLinkedList\DoublyNode::getPrev
     */
    public function testReverse()
    {
        $list = new CircularLinkedList();
        $list->add('first')->add('second')->add('third');

        $this->assertEquals('third', $list->getTail()->getData());
        $this->assertEquals('second', $list->getTail()->getPrev()->getData());
        $this->assertEquals('first', $list->getTail()->getPrev()->getPrev()->getData());
    }
}
