<?php

namespace Alan\Structure\LinkedList;

/**
 * Class Node
 * LinkedList Node.
 */
class Node
{
    /**
     * @var Node
     */
    private $next;

    /**
     * @var mixed
     */
    private $data;

    /**
     * Node constructor.
     * @param mixed $data
     * @param Node|null $next
     */
    public function __construct($data, Node $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }

    /**
     * Get next node.
     * @return Node
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Set next node.
     * @param Node $next
     * @return true
     */
    public function setNext(Node $next = null)
    {
        $this->next = $next;
        return true;
    }

    /**
     * Get data.
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data.
     * @param mixed $data
     * @return true
     */
    public function setData($data)
    {
        $this->data = $data;
        return true;
    }

    /**
     * To string
     * @return string
     */
    public function __toString()
    {
        $className = static::class;
        return "{$className}({$this->data})";
    }
}
