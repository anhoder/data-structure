<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 12:31 下午
 */

namespace Alan\Structure\Traits\LinkedList;

use Alan\Structure\Exception\CircularListException;

trait Next
{
    /**
     * @var self
     */
    private $next;

    /**
     * Next constructor.
     * @param self $next
     */
    public function __construct(self $next = null)
    {
        $this->next = $next;
    }

    /**
     * Get next node.
     * @return self
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Set next node.
     * @param self $next
     * @return true
     */
    public function setNext(self $next = null)
    {
        $this->next = $next;
        return true;
    }

    /**
     * Check whether list headed by the node has circle.
     * @param self $node
     * @return bool
     */
    public static function hasCircle(self $node)
    {
        if (is_null($node)) return false;

        $slowPointer = $fastPointer = $node;
        while (!is_null($fastPointer) && !is_null($slowPointer)) {
            // slow pointer move 1 step.
            $slowPointer = $slowPointer->getNext();

            // fast pointer move 2 step.
            $fastPointer = $fastPointer->getNext();
            if (is_null($fastPointer)) break;
            $fastPointer = $fastPointer->getNext();

            if ($fastPointer === $slowPointer) return true;
        }

        return false;
    }

    /**
     * Count next nodes.
     * @param Next $node
     * @param Next|null $head
     * @return int
     * @throws CircularListException
     */
    public static function count(self $node, self $head = null)
    {
        if (self::hasCircle($node)) throw new CircularListException($node);
        $length = 0;
        while (!is_null($node) && $node !== $head) {
            ++$length;
            $node = $node->getNext();
        }

        return $length;
    }

    /**
     * Get last node.
     * @param self $node
     * @return self|null
     */
    public static function getLast(self $node)
    {
        if (is_null($node)) return null;
        $tail = $node;
        while (!is_null($tail->getNext())) {
            $tail = $tail->getNext();
        }

        return $tail;
    }
}
