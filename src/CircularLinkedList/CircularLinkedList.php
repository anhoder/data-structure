<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/15 1:34 下午
 */

namespace Alan\Structure\CircularLinkedList;

use Alan\Structure\DoublyLinkedList\DoublyLinkedList;
use Alan\Structure\DoublyLinkedList\DoublyNode;

/**
 * Doubly circular linked list.
 * Class CircularLinkedList
 * @package Alan\Structure\CircularLinkedList
 */
class CircularLinkedList
{
    /**
     * @var DoublyLinkedList
     */
    private $doublyLinkedList;

    /**
     * CircularLinkedList constructor.
     */
    public function __construct()
    {
        $this->doublyLinkedList = new DoublyLinkedList();
    }

    /**
     * Add data
     * @param $data
     * @return $this
     */
    public function add($data)
    {
        $this->doublyLinkedList->add($data);
        $head = $this->doublyLinkedList->getHead();
        $tail = $this->doublyLinkedList->getTail();
        $head->setPrev($tail);
        $tail->setNext($head);

        return $this;
    }

    // add
    // insert
    // remove
    // set
    // get
    // getDistance
    // getLength
    // getHead
    // getTail

    // ArrayAccess
    // Iterator
}
