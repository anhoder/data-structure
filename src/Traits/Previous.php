<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 12:41 下午
 */

namespace Alan\Structure\Traits;

trait Previous
{
    /**
     * @var self
     */
    private $prev;

    /**
     * Previous constructor.
     * @param self $prev
     */
    public function __construct(self $prev = null)
    {
        $this->prev = $prev;
    }

    /**
     * Get previous node.
     * @return self
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * Set previous node.
     * @param self $prev
     * @return bool
     */
    public function setPrev(self $prev = null)
    {
        $this->prev = $prev;
        return true;
    }
}
