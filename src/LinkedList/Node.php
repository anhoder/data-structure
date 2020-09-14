<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 12:05 下午
 */

namespace Alan\Structure\LinkedList;

use Alan\Structure\Traits\LinkedList\Data;
use Alan\Structure\Traits\LinkedList\Next;

/**
 * Class Node
 * LinkedList Node.
 */
class Node
{
    use Data;
    use Next;

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

}
