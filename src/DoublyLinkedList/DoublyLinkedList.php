<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 2:24 下午
 */

namespace Alan\Structure\DoublyLinkedList;

use Alan\Structure\Exception\CircularListException;
use ArrayAccess;
use Iterator;

/**
 * Class DoublyLinkedList
 * @package Alan\Structure\DoublyLinkedList
 */
class DoublyLinkedList implements ArrayAccess, Iterator
{
    /**
     * First node of the list.
     * @var DoublyNode
     */
    protected $head;

    /**
     * Last node of list.
     * @var DoublyNode
     */
    protected $tail;

    /**
     * Cursor of the list.
     * @var int
     */
    protected $cursor;

    /**
     * Cursor node of list.
     * @var DoublyNode
     */
    protected $cursorNode;

    /**
     * The length of list.
     * @var int
     */
    protected $length;

    /**
     * DoublyLinkedList constructor.
     */
    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->cursorNode = $this->head;
        $this->cursor = 0;
        $this->length = 0;
    }

    /**
     * Get head of list.
     * @return DoublyNode|null
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Get tail of list.
     * @return DoublyNode|null
     */
    public function getTail()
    {
        return $this->tail;
    }

    /**
     * Get length of list.
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Get node of list by index.
     * @param int $index start with 0
     * @return DoublyNode|null
     */
    public function getNode(int $index)
    {
        if ($index > $this->length - 1 || $index < 0) return null;
        $distanceFromStart = $index;
        $distanceFromEnd = $this->length - $index - 1;

        if ($distanceFromStart <= $distanceFromEnd) {
            $distance = $distanceFromStart;
            $direction = 1;
            $cursor = $this->head;
        } else {
            $distance = $distanceFromEnd;
            $direction = -1;
            $cursor = $this->tail;
        }

        for ($i = 0; $i < $distance; ++$i) {
            if (is_null($cursor)) return null;
            if ($direction > 0) $cursor = $cursor->getNext();
            else $cursor = $cursor->getPrev();
        }

        return $cursor;
    }

    /**
     * Set node of list in index.
     * @param int $index
     * @param DoublyNode $node
     * @return $this|false
     * @throws CircularListException
     */
    public function setNode(int $index, DoublyNode $node)
    {
        if ($index == 0) {
            $this->head = $node;
            $this->tail = DoublyNode::getLast($node);
            $this->length = DoublyNode::count($node);
            return $this;
        }

        if ($index > $this->length || $index < 0) return false;

        $prevNode = $this->getNode($index - 1);
        if (is_null($prevNode)) return false;

        $objNode = $prevNode->getNext();

        // update length
        $objCount = DoublyNode::count($objNode);
        $count = DoublyNode::count($node);
        $this->length = $this->length + $count - $objCount;
        $this->tail = DoublyNode::getLast($node);

        if (!is_null($node)) $node->setPrev($prevNode);
        $prevNode->setNext($node);

        return $this;
    }

    /**
     * Insert node into index.
     * @param int $index
     * @param DoublyNode $node
     * @return $this|false
     */
    public function insertNode(int $index, DoublyNode $node)
    {
        if (is_null($node)) return false;
        if ($index == 0) {
            $node->setNext($this->head);
            $node->setPrev(null);
            $this->head = $node;
            if ($this->length == 0) $this->tail = $node;
            ++$this->length;

            return $this;
        }
        if ($index > $this->length || $index < 0) return false;

        $prevNode = $this->getNode($index - 1);
        if (is_null($prevNode)) return false;

        $nextNode = $prevNode->getNext();
        $node->setNext($nextNode);
        if (!is_null($nextNode)) $nextNode->setPrev($node);
        $prevNode->setNext($node);
        $node->setPrev($prevNode);

        // Insert to last of list.
        if ($index == $this->length) {
            $this->tail = $node;
        }
        ++$this->length;

        return $this;
    }

    /**
     * Add node to the end of list.
     * @param DoublyNode $node
     * @return $this|false
     */
    public function addNode(DoublyNode $node)
    {
        if (is_null($node)) return false;

        $node->setNext(null);
        $node->setPrev(null);
        if ($this->length == 0) {
            $this->head = $node;
            $this->tail = $node;
            ++$this->length;

            return $this;
        }

        $this->tail->setNext($node);
        $node->setPrev($this->tail);
        $this->tail = $node;
        ++$this->length;

        return $this;
    }

    /**
     * Remove the node in index of list.
     * @param int $index
     * @return $this|false
     */
    public function removeNode(int $index)
    {
        if ($index > $this->length - 1 || $index < 0) return false;
        if ($index == 0) {
            $this->head = $this->head->getNext();
            if (!is_null($this->head)) $this->head->setPrev(null);
            if ($this->head == null) $this->tail = $this->head;
            --$this->length;

            return $this;
        }

        $prev = $this->getNode($index - 1);
        $delete = $prev->getNext();
        $prev->setNext($delete->getNext());
        if (!is_null($delete->getNext())) $delete->getNext()->setPrev($prev);
        if ($index == $this->length - 1) {
            $this->tail = $prev;
        }
        --$this->length;

        return $this;
    }

    /**
     * Get data in index.
     * @param int $index
     * @return mixed|null
     */
    public function get(int $index)
    {
        $node = $this->getNode($index);
        if (is_null($node)) return null;

        return $node->getData();
    }

    /**
     * Add data to the end.
     * @param $data
     * @return $this
     */
    public function add($data)
    {
        $node = new DoublyNode($data);
        return $this->addNode($node);
    }

    /**
     * Set data in index.
     * @param int $index
     * @param $data
     * @return $this|false
     */
    public function set(int $index, $data)
    {
        if ($index == $this->length) {
            $this->add($data);
            return $this;
        }
        $node = $this->getNode($index);
        if (is_null($node)) return false;

        $node->setData($data);

        return $this;
    }

    /**
     * Insert data into list.
     * @param int $index
     * @param $data
     * @return $this|false
     */
    public function insert(int $index, $data)
    {
        $node = new DoublyNode($data);
        return $this->insertNode($index, $node);
    }

    /**
     * Remove node.
     * @param int $index
     * @return $this|false
     */
    public function remove(int $index)
    {
        return $this->removeNode($index);
    }

    /**
     * Clear list.
     * @return $this
     */
    public function clear()
    {
        $this->head = null;
        $this->cursor = 0;
        $this->cursorNode = null;
        $this->tail = null;
        $this->length = 0;

        return $this;
    }

    /**
     * Get current data.
     * @return mixed|null
     */
    public function current()
    {
        if (is_null($this->cursorNode)) return null;
        return $this->cursorNode->getData();
    }

    /**
     * Next.
     */
    public function next()
    {
        if (!is_null($this->cursorNode)) {
            $this->cursorNode = $this->cursorNode->getNext();
            ++$this->cursor;
        }
    }

    /**
     * Get key.
     * @return int
     */
    public function key()
    {
        return $this->cursor;
    }

    /**
     * Is cursor valid?
     * @return bool
     */
    public function valid()
    {
        return $this->cursor <= $this->length - 1 && $this->cursor >= 0;
    }

    /**
     * Rewind.
     */
    public function rewind()
    {
        $this->cursor = 0;
        $this->cursorNode = $this->head;
    }

    /**
     * Is offset exists?
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $offset <= $this->length - 1 && $offset >= 0;
    }

    /**
     * Get data in offset.
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Set data in offset.
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * Remove data in offset.
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}
