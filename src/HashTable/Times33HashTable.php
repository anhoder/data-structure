<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/30 5:01 下午
 */

namespace Alan\Structure\HashTable;

/**
 * Class Times33HashTable
 * @package Alan\Structure\HashTable
 */
class Times33HashTable extends HashTable
{

    /**
     * @inheritDoc
     */
    protected function hash(string $key): int
    {
        $hash = 5381;

        $len = strlen($key);
        for ($i = 0; $i < $len; ++$i) {
            $hash = ($hash << 5) + $hash + ord($key[$i]);
        }

        return $hash;
    }
}
