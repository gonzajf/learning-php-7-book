<?php

namespace Bookstore\Utils;

use Bookstore\Exceptions\InvalidIdException;

trait Unique {

    protected $id;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }
}