<?php

require __DIR__ . '/../../vendor/autoload.php';

use Alan\Structure\LinkedList\LinkedList;
use Alan\Structure\LinkedList\Node;
use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase
{
    /**
     * @var LinkedList
     */
    private $linkedList;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->linkedList = new LinkedList();
    }

    /**
     * @test Test insert node.
     */
    public function testInsertNode()
    {
        // Insert.
        $this->linkedList->insertNode(0, new Node('first'));
        $this->assertEquals('first', $this->linkedList->get(0));
        $this->assertEquals(1, $this->linkedList->getLength());

        // Out of bounds.
        $this->linkedList->insertNode(2, new Node('no insert'));
        $this->assertEquals(null, $this->linkedList->get(2));
        $this->assertEquals(1, $this->linkedList->getLength());

        // Insert.
        $this->linkedList->insertNode(1, new Node('second'));
        $this->assertEquals('second', $this->linkedList->get(1));
        $this->assertEquals(2, $this->linkedList->getLength());

        // Insert data, out of bounds.
        $this->linkedList->insert(10, 'no insert');
        $this->assertEquals(null, $this->linkedList->get(10));
        $this->assertEquals(2, $this->linkedList->getLength());

        // Insert data.
        $this->linkedList->insert(2, 'third');
        $this->assertEquals('third', $this->linkedList->get(2));
        $this->assertEquals(3, $this->linkedList->getLength());
    }
}
