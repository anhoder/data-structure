<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 12:05 下午
 */

namespace Alan\Structure\DoublyLinkedList;

use Alan\Structure\Traits\LinkedList\Data;
use Alan\Structure\Traits\LinkedList\Next;
use Alan\Structure\Traits\LinkedList\Previous;

class DoublyNode
{
    use Previous;
    use Data;
    use Next;

    /**
     * DoublyNode constructor.
     * @param $data
     * @param DoublyNode|null $prev
     * @param DoublyNode|null $next
     */
    public function __construct($data, DoublyNode $prev = null, DoublyNode $next = null)
    {
        $this->data = $data;
        $this->prev = $prev;
        $this->next = $next;
    }
}
