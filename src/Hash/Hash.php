<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/27 1:46 下午
 */

namespace Alan\Structure\Hash;

interface Hash extends \ArrayAccess, \Iterator
{
    /**
     * Does the hash has key?
     * @param $key
     * @return mixed
     */
    public function has($key);

    /**
     * Get data.
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * Set data.
     * @param $key
     * @param $data
     * @return mixed
     */
    public function set($key, $data);

    /**
     * Is the hash empty?
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Remove data.
     * @param $key
     * @return mixed
     */
    public function remove($key);

    /**
     * Reset hash.
     * @return mixed
     */
    public function reset();
}
