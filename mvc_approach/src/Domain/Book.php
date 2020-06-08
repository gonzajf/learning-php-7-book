<?php

namespace Bookstore\Domain;

class Book {

    private $id;
    private $isbn;
    private $title;
    private $author;
    private $stock;
    private $price;

    public function __construct(int $isbn, string $title, string $author, int $available = 0) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
    }

    public function getId(){
        return $this->id;
    }
    public function getIsbn(): int {
        return $this->isbn;
    }
    public function getTitle(): string {
        return $this->title;
    }
    public function getAuthor(): string {
        return $this->author;
    }
    public function getStock(): int {
        return $this->stock;
    }

    public function getCopy(): bool {
        if ($this->stock < 1) {
            return false;
        } else {
            $this->stock--;
            return true;
        }
    }

    public function addCopy() {
        $this->stock++;
    }

    public function getPrice() : float {
        return $this->price;
    }
}