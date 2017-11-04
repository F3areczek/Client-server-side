<?php

use App\Model;

class User extends Repository{


    public function register($data) {
        unset($data["password2"]);
        $data["role"] = "guest";
        $data["password"] = $this->passwordHash($data["password"]);
        return $this->connection->table(self::USER_TABLE)->insert($data);
    }

    public function passwordHash($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function existingUser($email) {
        if ($this->connection->table(self::USER_TABLE)->where('email', $email)->fetch())
            return true;
        else
            return false;
    }

    public function getUsers() {
        return $this->connection->table(self::USER_TABLE)->fetchAll();
    }

    public function updateRole($iduser, $role){
        $this->connection->table(self::USER_TABLE)->where("id", $iduser)->update(array("role" => $role));
    }

    public function updateUser($iduser, $valuse){
        $this->connection->table(self::USER_TABLE)->where("id", $iduser)->update($valuse);
    }


}
