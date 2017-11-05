<?php

use App\Model;

class Flower extends Repository{

    public function getFlowers() {
        return $this->connection->query("SELECT ".self::FLOWER_TABLE.".*, ".self::USER_TABLE .".name as 'author' FROM `flowers` JOIN users ON users.id = flowers.users_id ORDER BY ".self::FLOWER_TABLE.".name")->fetchAll();
    }

    public function getActiveFlowers() {
        return $this->connection->query("SELECT ".self::FLOWER_TABLE.".*, ".self::USER_TABLE .".name as 'author' FROM `flowers` JOIN users ON users.id = flowers.users_id WHERE ".self::FLOWER_TABLE.".accepted = 1 ORDER BY ".self::FLOWER_TABLE.".name")->fetchAll();
    }

    public function getActiveRatedFlowers() {
        return $this->connection->query("SELECT ".self::FLOWER_TABLE.".*, ROUND((SUM(".self::EVALUATION_TABLE.".value)/COUNT(".self::EVALUATION_TABLE.".value)),2) as 'score' FROM `".self::FLOWER_TABLE."` JOIN ".self::EVALUATION_TABLE." ON ".self::EVALUATION_TABLE.".idflower = ".self::FLOWER_TABLE.".id WHERE ".self::FLOWER_TABLE.".accepted = 1 GROUP BY ".self::EVALUATION_TABLE.".idflower ORDER BY ROUND((SUM(".self::EVALUATION_TABLE.".value)/COUNT(".self::EVALUATION_TABLE.".value)),2) DESC")->fetchAll();
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

    public function rateFlower($flower, $user, $rate){
        return $this->connection->table(self::EVALUATION_TABLE)->insert(array("iduser" => $user, "idflower" => $flower, "value" => $rate));
    }

    public function getMyRating($iduser, $idflower){
        return $this->connection->table(self::EVALUATION_TABLE)->select("*")->where('iduser', $iduser)->where('idflower', $idflower)->fetch();
    }




}
