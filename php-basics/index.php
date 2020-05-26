<?php
echo 'Hello world';

echo ' ';
//Variables
$a = 1;
$b = 2;
$c = $a + $b;
echo $c; // 3
?>
<h3>more variables</h3>
<?php
$_some_value = 'abc'; // valid
//$1number = 12.3; // not valid!
//$some$signs% = '&^%'; // not valid!
echo $go_2_home = "ok"; // valid
echo $go_2_Home = 'no'; // this is a different variable
echo $isThisCamelCase = true; // camel case
?>
<h3>variable reassignation</h3>
<?php
$number = 123;
var_dump($number);
$number = 'abc';
var_dump($number);

$a = "1";
$b = 2;
var_dump($a + $b); // 3
var_dump($a . $b); // 12