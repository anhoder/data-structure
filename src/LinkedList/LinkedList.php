<?php

namespace Alan\Structure\LinkedList;

class LinkedList
{
    /**
     * First node of list.
     * @var Node
     */
    private $head;

    /**
     * Cursor node of the list.
     * @var Node
     */
    private $cursor;

    /**
     * Length of the list.
     * @var int
     */
    private $length;

    /**
     * LinkedList constructor.
     */
    public function __construct()
    {
        $this->head = null;
        $this->cursor = $this->head;
        $this->length = 0;
    }

    /**
     * Get head of list..
     * @return Node|null
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Get length.
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Count next nodes.
     * @param Node $node
     * @return int
     */
    public static function count(Node $node)
    {
        $length = 0;
        while (!is_null($node)) {
            ++$length;
            $node = $node->getNext();
        }

        return $length;
    }

    /**
     * Get node of list by index.
     * @param int $index start with 0
     * @return Node|null
     */
    public function getNode(int $index)
    {
        if ($index > $this->length - 1 || $index < 0) return null;
        $cursor = $this->head;
        for ($i = 0; $i < $index; ++$i) {
            if (is_null($cursor)) return null;
            $cursor = $cursor->getNext();
        }

        return $cursor;
    }

    /**
     * Override object node with input node.
     * <b>Notice: All nodes followed the input node will replace also.</b>
     * @param int $index start with 0
     * @param Node $node
     * @return false|LinkedList
     */
    public function setNode(int $index, Node $node)
    {
        if ($this->length == 0 && $index == 0) {
            $this->head = $node;
            $this->length = self::count($node);
            return $this;
        }

        if ($index > $this->length || $index < 0) return false;

        $prevNode = $this->getNode($index - 1);
        if (is_null($prevNode)) return false;

        $objNode = $prevNode->getNext();

        // update length
        $objCount = self::count($objNode);
        $count = self::count($node);
        $this->length = $this->length + $count - $objCount;

        $prevNode->setNext($node);

        return $this;
    }

    /**
     * Insert node into list.
     * @param int $index start with 0
     * @param Node $node
     * @return $this|false
     */
    public function insertNode(int $index, Node $node)
    {
        if ($index == 0 && $this->length == 0) {
            $node->setNext(null);
            $this->head = $node;
            ++$this->length;

            return $this;
        }
        if ($index > $this->length || $index < 0) return false;

        $prevNode = $this->getNode($index - 1);
        if (is_null($prevNode)) return false;

        $nextNode = $prevNode->getNext();
        $node->setNext($nextNode);
        $prevNode->setNext($node);

        ++$this->length;

        return $this;
    }

    /**
     * Add node to the end.
     * @param Node $node
     * @return LinkedList
     */
    public function addNode(Node $node)
    {
        $node->setNext(null);
        if ($this->length == 0) {
            $this->head = $node;
            ++$this->length;

            return $this;
        }

        $last = $this->getNode($this->length - 1);
        $last->setNext($node);
        ++$this->length;

        return $this;
    }

    /**
     * Remove node.
     * @param int $index
     * @return $this|false
     */
    public function removeNode(int $index)
    {
        if ($index > $this->length - 1 || $index < 0) return false;
        if ($index == 0) {
            $this->head = $this->head->getNext();
            --$this->length;

            return $this;
        }

        $prev = $this->getNode($index - 1);
        $delete = $prev->getNext();
        $prev->setNext($delete->getNext());
        --$this->length;

        return $this;
    }

    /**
     * Get data of list by index.
     * @param int $index start with 0
     * @return mixed
     */
    public function get(int $index)
    {
        $node = $this->getNode($index);
        if (is_null($node)) return null;

        return $node->getData();
    }

    /**
     * Replace data of object node.
     * @param int $index
     * @param mixed $data
     * @return false|LinkedList
     */
    public function set(int $index, $data)
    {
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
        $node = new Node($data);
        return $this->insertNode($index, $node);
    }

    /**
     * Add data to the end.
     * @param $data
     * @return $this
     */
    public function add($data)
    {
        $node = new Node($data);
        return $this->addNode($node);
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
     * @return LinkedList
     */
    public function clear()
    {
        $this->head = null;
        $this->length = 0;

        return $this;
    }
}
