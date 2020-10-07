<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/10/7 8:59 下午
 */

namespace Alan\Structure\Set;

/**
 * Interface SetInterface
 * @package Alan\Structure\Set
 */
interface SetInterface
{
    /**
     * Exists data in set.
     * @param string $data
     * @return bool
     */
    public function exists(string $data): bool;

    /**
     * Add data to set.
     * @param string $data
     * @return bool
     */
    public function add(string $data): bool;

    /**
     * Remove data from set.
     * @param string $data
     * @return bool
     */
    public function remove(string $data): bool;

    /**
     * Get length of set.
     * @return int
     */
    public function getLength(): int;

    /**
     * Get and remove random data.
     * @return string
     */
    public function pop(): string;
}
