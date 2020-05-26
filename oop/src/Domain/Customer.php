<?php

namespace Bookstore\Domain;

class Customer extends  Person {

    private static $lastId = 0;

    private $id;
    private $email;

    public function __construct(int $id, string $firstname, string $surname, string $email) {

        parent::__construct($firstname, $surname);
        if ($id == null) {
            $this->id = ++self::$lastId;
        } else {
            $this->id = $id;
            if ($id > self::$lastId) {
                self::$lastId = $id;
            }
        }
        $this->email = $email;
    }

    public static function getLastId(): int {
        return self::$lastId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
}