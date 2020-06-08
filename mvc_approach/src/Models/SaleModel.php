<?php


namespace Bookstore\Models;

use Bookstore\Domain\Sale;
use Bookstore\Exceptions\DbException;
use PDO;

class SaleModel extends AbstractModel {

    const CLASSNAME = '\Bookstore\Domain\Sale';

    public function getByUser(int $userId): array {

        $query = 'SELECT * FROM sale WHERE s.customer_id = :user';
        $sth = $this->getDb()->prepare($query);
        $sth->execute(['user' => $userId]);
        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }

    public function get(int $saleId): Sale {

        $query = 'SELECT * FROM sale WHERE id = :id';
        $sth = $this->getDb()->prepare($query);
        $sth->execute(['id' => $saleId]);
        $sales = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

        if (empty($sales)) {
            throw new NotFoundException('Sale not found.');
        }

        $sale = array_pop($sales);
        $query = 'SELECT b.id, b.title, b.author, b.price, sb.amount as stock, b.isbn
                    FROM sale s
                    LEFT JOIN sale_book sb ON s.id = sb.sale_id
                    LEFT JOIN book b ON sb.book_id = b.id
                    WHERE s.id = :id';

        $sth = $this->getDb()->prepare($query);
        $sth->execute(['id' => $saleId]);

        $books = $sth->fetchAll(
            PDO::FETCH_CLASS, BookModel::CLASSNAME
        );
        $sale->setBooks($books);
        return $sale;
    }

    public function create(Sale $sale) {

        $this->getDb()->beginTransaction();
        $query = 'INSERT INTO sale(customer_id, date) VALUES(:id, NOW())';
        $sth = $this->getDb()->prepare($query);

        if (!$sth->execute(['id' => $sale->getCustomerId()])) {
            $this->getDb()->rollBack();
            throw new DbException($sth->errorInfo()[2]);
        }
        $saleId = $this->getDb()->lastInsertId();
        $query = 'INSERT INTO sale_book(sale_id, book_id, amount) VALUES(:sale, :book, :amount)';
        $sth = $this->getDb()->prepare($query);
        $sth->bindValue('sale', $saleId);
            
        foreach ($sale->getBooks() as $bookId => $amount) {
            $sth->bindValue('book', $bookId);
            $sth->bindValue('amount', $amount);

            if (!$sth->execute()) {
                $this->getDb()->rollBack();
                throw new DbException($sth->errorInfo()[2]);
            }
        }
        $this->getDb()->commit();
    }
}