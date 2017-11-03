<?php

use Nette\Security as NS;

class Authenticator extends Repository implements NS\IAuthenticator
{

    function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $row = $this->connection->table(self::USER_TABLE)->where('email', $username)->fetch();

        if (!$row) {
            throw new NS\AuthenticationException('User not found.');
        }

        if (!NS\Passwords::verify($password, $row->password)) {
            throw new NS\AuthenticationException('Invalid password.');
        }

        return new NS\Identity($row->id, $row->role, ['email' => $row->email]);
    }
}