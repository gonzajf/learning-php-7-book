<?php

use Bookstore\Domain\Book;
use Bookstore\Domain\Customer;
use Bookstore\Domain\Customer\CustomerFactory;
use Bookstore\Domain\Customer\Basic;
use Bookstore\Domain\Customer\Premium;
use Bookstore\Domain\Person;
use Bookstore\Utils\Config;
use Bookstore\Utils\Unique;

function autoload($classname) {
    $lastSlash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/src/' . $directory . '.php';
    require_once($filename);
}

spl_autoload_register('autoload');

$book1 = new Book(9785267006323,"1984", "George Orwell",  12);
//$book2 = new Book(9780061120084, "To Kill a Mockingbird", "Harper Lee" , 2);

//$customer1 = new Customer(1, 'John', 'Doe', 'johndoe@mail.com');
//$customer2 = new Customer(2, 'Mary', 'Poppins', 'mp@mail.com');

function checkIfValid(Customer $customer, array $books): bool {
    return $customer->getAmountToBorrow() >= count($books);
}

//$basic = new Basic(1, "name", "surname", "email");
//$premium = new Premium(null, "name", "surname", "email");
//var_dump(Person::getLastId()); // 2
//var_dump(Unique::getLastId()); // 0
//var_dump(Basic::getLastId()); // 2
//var_dump(Premium::getLastId()); // 2
//try {
//    $basic = new Basic(-1, "name", "surname", "email");
//} catch (\Exception $e) {
//    echo 'Something happened when creating the basic customer: ' . $e->getMessage();
//}
//
//function createBasicCustomer($id)
//{
//    try {
//        echo "\nTrying to create a new customer.\n";
//        return new Basic($id, "name", "surname", "email");
//    } catch (Exception $e) {
//        echo "Something happened when creating the basic customer: "
//            . $e->getMessage() . "\n";
//    } finally {
//        echo "End of function.\n";
//    }
//}
//createBasicCustomer(1);
//createBasicCustomer(-1);

$basic = CustomerFactory::factory('basic', 2, 'mary', 'poppins', 'mary@poppins.com');
$premium = CustomerFactory::factory('premium', null, 'james', 'bond', 'james@bond.com');

var_dump($basic);
var_dump($premium);

$addTaxes = function (array &$book, $index, $percentage) {
    $book['price'] += round($percentage * $book['price'], 2);
};

$books = [
    ['title' => '1984', 'price' => 8.15],
    ['title' => 'Don Quijote', 'price' => 12.00],
    ['title' => 'Odyssey', 'price' => 3.55]
];

array_walk($books, $addTaxes, 0.16);

var_dump($books);

/*$dbConfig = Config::getInstance()->get('db');
$db = new PDO(
    'mysql:host=127.0.0.1;dbname=bookstore',
    $dbConfig['user'],
    $dbConfig['password']
);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$rows = $db->query('SELECT * FROM book ORDER BY title');
foreach ($rows as $row) {
    var_dump($row);
}*/
/*
$query = <<<SQL
INSERT INTO book (isbn, title, author, price)
VALUES ("9788187981954", "Peter Pan", "J. M. Barrie", 2.34)
SQL;
$result = $db->exec($query);
var_dump($result);
$error = $db->errorInfo()[2];
var_dump($error); // Duplicate entry '9788187981954' for key 'isbn'*/

/*
$query = 'SELECT * FROM book WHERE author = :author';
$statement = $db->prepare($query);
$statement->bindValue('author', 'George Orwell');
$statement->execute();
$rows = $statement->fetchAll();
var_dump($rows);*/

/*$query = <<<SQL
INSERT INTO book (isbn, title, author, price)
VALUES (:isbn, :title, :author, :price)
SQL;
$statement = $db->prepare($query);
$params = [
    'isbn' => '9781412108614',
    'title' => 'Iliad',
    'author' => 'Homer',
    'price' => 9.25
];
$statement->execute($params);
echo $db->lastInsertId(); // 8*/

function addSale(int $userId, array $bookIds) {
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=bookstore',
        'root',
        'root'
    );
    $db->beginTransaction();
    try {
        $query = 'INSERT INTO sale (customer_id, date) '. 'VALUES(:id, NOW())';
        $statement = $db->prepare($query);
        if (!$statement->execute(['id' => $userId])) {
            throw new Exception($statement->errorInfo()[2]);
        }
        $saleId = $db->lastInsertId();
        $query = 'INSERT INTO sale_book (book_id, sale_id) '
            . 'VALUES(:book, :sale)';
        $statement = $db->prepare($query);
        $statement->bindValue('sale', $saleId);
        foreach ($bookIds as $bookId) {
            $statement->bindValue('book', $bookId);
            if (!$statement->execute()) {
                throw new Exception($statement->errorInfo()[2]);
            }
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
        throw $e;
    }
}

try {
    addSale(1, [1, 2, 3]);
} catch (Exception $e) {
    echo 'Error adding sale: ' . $e->getMessage();
}