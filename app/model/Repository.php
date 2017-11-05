<?php

abstract class Repository extends Nette\Object {

    const USER_TABLE = "users";
    const FLOWER_TABLE = "flowers";
    const EVALUATION_TABLE = "evaluation";

    /** @var Nette\Database\Context */
    protected $connection;

    public function __construct(Nette\Database\Context $db) {
        $this->connection = $db;
    }

    public function table($table) {
        return $this->connection->table($table);
    }
    
    public function query($query){
        return $this->connection->query($query);
    }
}