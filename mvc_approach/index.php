<?php

require_once __DIR__ . '/vendor/autoload.php';

use Bookstore\Core\Db;
use Bookstore\Models\BookModel;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$twig = new Twig_Environment($loader);

$bookModel = new BookModel(Db::getInstance());
$book = $bookModel->get(1);

$params = ['book' => $book];
echo $twig->loadTemplate('book.twig')->render($params);