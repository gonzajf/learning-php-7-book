<?php
var_dump(2 < 3); // true
var_dump(3 < 3); // false
var_dump(3 <= 3); // true
var_dump(4 <= 3); // false
var_dump(2 > 3); // false
var_dump(3 >= 3); // true
var_dump(3 > 3); // false
var_dump(1 <=> 2); // int less than 0
var_dump(1 <=> 1); // 0
var_dump(3 <=> 2); // int greater than 0

$a = 3;
$b = '3';
$c = 5;
var_dump($a == $b); // true
var_dump($a === $b); // false
var_dump($a != $b); // false
var_dump($a !== $b); // true
var_dump($a == $c); // false
var_dump($a <> $c); // true




