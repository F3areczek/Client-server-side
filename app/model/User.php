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
}
