<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 12:50 下午
 */

namespace Alan\Structure\Stack;

/**
 * Interface StackInterface
 * @package Alan\Structure\Stack
 */
interface StackInterface
{
    /**
     * Is the stack empty
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Reset stack.
     * @return mixed
     */
    public function reset();

    /**
     * Push data into stack.
     * @param $data
     * @return mixed
     */
    public function push($data);

    /**
     * Pop data from stack.
     * @return mixed
     */
    public function pop();
}
