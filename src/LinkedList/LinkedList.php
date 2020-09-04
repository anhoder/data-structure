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
     * Get first node of list.
     * @return Node
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Set first node of list.
     * @param Node $head
     * @return LinkedList
     */
    public function setHead(Node $head)
    {
        $this->head = $head;
        return $this;
    }

    /**
     * Get node of list by index.
     * @param int $index start with 0
     * @return Node|null
     */
    public function getNode(int $index)
    {
        if ($index > $this->length - 1) return null;
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
        if ($index > $this->length - 1) return false;

        $prevNode = $this->getNode($index - 1);
        if (is_null($prevNode)) return false;

        $prevNode->setNext($node);

        return $this;
    }

    public function addNode(int $index, Node $node)
    {
        // TODO
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

    public function add(Node $node, int $index = -1)
    {
        // TODO
    }

    public function remove(int $index)
    {
        // TODO
    }
}
