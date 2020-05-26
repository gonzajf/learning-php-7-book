<?php

use Bookstore\Domain\Book;
use Bookstore\Domain\Customer;

function autoload($classname) {
    $lastSlash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/src/' . $directory . '.php';
    require_once($filename);
}

spl_autoload_register('autoload');

$book1 = new Book(9785267006323,"1984", "George Orwell",  12);
$book2 = new Book(9780061120084, "To Kill a Mockingbird", "Harper Lee" , 2);

$customer1 = new Customer(1, 'John', 'Doe', 'johndoe@mail.com');
$customer2 = new Customer(2, 'Mary', 'Poppins', 'mp@mail.com');

var_dump($book1);
var_dump($book2);
var_dump($customer1);
var_dump($customer2);
