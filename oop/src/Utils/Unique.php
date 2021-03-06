<?php

namespace Bookstore\Utils;

use Bookstore\Exceptions\InvalidIdException;

trait Unique {

    private static $lastId = 0;
    protected $id;

    public function setId(int $id = null){

        if($id < 0) {
            throw new InvalidIdException("Id cannot be null");
        }

        if (empty($id)) {
            $this->id = ++self::$lastId;
        } else {
            $this->id = $id;
            if ($id > self::$lastId) {
                self::$lastId = $id;
            }
        }
    }

    public static function getLastId(): int {
        return self::$lastId;
    }

    public function getId(): int {
        return $this->id;
    }
}