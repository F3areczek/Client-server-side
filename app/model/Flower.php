<?php

use App\Model;

class Flower extends Repository{

    public function getFlowers() {
        return $this->connection->query("SELECT ".self::FLOWER_TABLE.".*, ".self::USER_TABLE .".name as 'author' FROM `flowers` JOIN users ON users.id = flowers.users_id")->fetchAll();
    }

    public function updateFlower($id, $valuse){
        $this->connection->table(self::FLOWER_TABLE)->where("id", $id)->update($valuse);
    }

    public function saveFlower($data){
        return $this->connection->table(self::FLOWER_TABLE)->insert($data);
    }

    public function getFlower($id) {
        return $this->connection->query("SELECT ".self::FLOWER_TABLE.".*, ".self::USER_TABLE .".name as 'author' FROM `flowers` JOIN users ON users.id = flowers.users_id WHERE ".self::FLOWER_TABLE.".id = $id")->fetch();
    }

    public function updateFlowerWithoutId($valuse){
        $this->connection->table(self::FLOWER_TABLE)->update($valuse);
    }




}
