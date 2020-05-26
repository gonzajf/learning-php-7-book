<?php
$text = '   How can a clam cram in a clean cream can? ';
echo strlen($text); // 45
$text = trim($text);
echo $text; // How can a clam cram in a clean cream can?
echo strtoupper($text); // HOW CAN A CLAM CRAM IN A CLEAN CREAM CAN?
echo strtolower($text); // how can a clam cram in a clean cream can?
$text = str_replace('can', 'could', $text);
echo $text; // How could a clam cram in a clean cream could?
echo substr($text, 2, 6); // w coul
var_dump(strpos($text, 'can')); // false
var_dump(strpos($text, 'could')); // 4

$firstname = 'Hiro';
$surname = 'Nakamura';
echo 'I am ' . $firstname . ' ' . $surname . '!';

echo "My name is $firstname $surname.\n I am a master of time and space. \"Yatta!\"";
