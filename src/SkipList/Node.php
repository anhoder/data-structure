<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/8 11:46 下午
 */

namespace Alan\Structure\SkipList;

/**
 * Class Node of SkipList.
 * @package Alan\Structure\SkipList
 */
class Node
{
    /**
     * The level of the node.
     * @var int
     */
    protected $level;

    /**
     * Next node.
     * @var static
     */
    protected $next;

    /**
     * Self in lower level.
     * @var static
     */
    protected $lowerSelf;

    /**
     * Data.
     * @var mixed
     */
    protected $value;
}
