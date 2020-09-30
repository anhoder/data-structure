<?php

require './vendor/autoload.php';

$table = new Alan\Structure\HashTable\Times33HashTable();

for ($i = 0; $i < 100; ++$i) {
    $table->set($i, $i);
}

$count = 0;
foreach ($table as $k => $v) {
    dump("$k => $v");
    ++$count;
}
dd($table);
