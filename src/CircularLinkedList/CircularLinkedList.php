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
class CircularLinkedList extends DoublyLinkedList
{
    /**
     * Add node to the end of list.
     * @param DoublyNode $node
     * @return $this
     */
    public function addNode(DoublyNode $node)
    {
        $res = parent::addNode($node);
        if ($res !== false) $this->updateLinkOfCircle();

        return $this;
    }

    /**
     * Insert node into list.
     * @param int $index
     * @param DoublyNode $node
     * @return $this|CircularLinkedList|false
     */
    public function insertNode(int $index, DoublyNode $node)
    {
        $isHeadOrTail = $index == 0 || $index == $this->length;
        $res = parent::insertNode($index, $node);

        if ($res !== false && $isHeadOrTail) $this->updateLinkOfCircle();

        return $res;
    }

    /**
     * Remove node of list.
     * @param int $index
     * @return CircularLinkedList|false|void
     */
    public function removeNode(int $index)
    {
        $isHeadOrTail = $index == 0 || $index == $this->length - 1;
        $res = parent::removeNode($index);
        if ($res !== false && $isHeadOrTail) $this->updateLinkOfCircle();

        return $res;
    }

    /**
     * Set node.
     * @param int $index
     * @param DoublyNode $node
     * @throws \Exception
     * @removed
     */
    public function setNode(int $index, DoublyNode $node)
    {
        throw new \Exception('The method is removed');
    }

    /**
     * Get node in index.
     * @param int $index
     * @return DoublyNode|null
     */
    public function getNode(int $index)
    {
        if ($index > $this->length - 1) return null;
        if ($this->cursor == 0 || is_null($this->cursorNode)) {
            $this->cursor = $index;
            $this->cursorNode = parent::getNode($index);

            return $this->cursorNode;
        }

        $distance = $this->getDistance($this->cursor, $index);
        $absDistance = abs($distance);

        for ($i = 0; $i < $absDistance; ++$i) {
            if ($distance > 0) $this->cursorNode = $this->cursorNode->getNext();
            else $this->cursorNode = $this->cursorNode->getPrev();
        }

        $this->cursor = $index;

        return $this->cursorNode;
    }

    /**
     * Get distance between two item.
     * @param int $start
     * @param int $end
     * @return int
     */
    public function getDistance(int $start, int $end)
    {
        if ($end - $start > 0) {
            $forwardDistance = $end - $start;
            $backwardDistance = $this->length - $end + $start;
        } else {
            $backwardDistance = $start - $end;
            $forwardDistance = $this->length - $start + $end;
        }

        if (abs($forwardDistance) <= abs($backwardDistance)) return $forwardDistance;
        else return -$backwardDistance;
    }

    /**
     * Update link of circular linked list.
     */
    protected function updateLinkOfCircle()
    {
//        $head = $this->getHead();
//        $tail = $this->getTail();
        $this->head->setPrev($this->tail);
        $this->tail->setNext($this->head);
    }
}
