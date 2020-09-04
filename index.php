<?php

use Alan\Structure\LinkedList\LinkedList;
use Alan\Structure\LinkedList\Node;

require './vendor/autoload.php';

$list = new LinkedList();
$node = new Node(123);
$list->setHead($node);

$cursor = $list->getHead();
while ($cursor) {
var_dump($cursor);
$cursor = $cursor->getNext();
}
