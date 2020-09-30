<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/27 1:46 下午
 */

namespace Alan\Structure\Hash;

use ArrayAccess;
use Iterator;

interface HashTableInterface extends ArrayAccess, Iterator
{
    /**
     * Does the hash has key?
     * @param string $key
     * @return mixed
     */
    public function has(string $key);

    /**
     * Get data.
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * Set data.
     * @param string $key
     * @param $data
     * @return mixed
     */
    public function set(string $key, $data);

    /**
     * Is the hash empty?
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Remove data.
     * @param string $key
     * @return mixed
     */
    public function remove(string $key);

    /**
     * Reset hash.
     * @return mixed
     */
    public function reset();
}
