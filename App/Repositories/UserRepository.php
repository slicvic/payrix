<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\UsernameAlreadyTakenException;
use App\Exceptions\ValidationException;

class UserRepository extends Repository
{
    /**
     * @param  User   $user
     * @throws ValidationException
     * @throws UsernameAlreadyTakenException
     */
    public function insert(User $user)
    {
        if (is_array($errors = $user->valid())) {
            throw new ValidationException($errors);
        }

        if ((bool) $this->findByUsername($user->username)) {
            throw new UsernameAlreadyTakenException;
        }

        $user->password = password_hash($user->password, PASSWORD_DEFAULT);

        $stmt = static::getDb()->prepare('
            INSERT INTO
                users
            SET
                fullname = ?,
                username = ?,
                password = ?,
                created_at = NOW()
        ');

        $result = $stmt->execute([
            $user->fullname,
            $user->username,
            $user->password
        ]);

        return $result;
    }

    /**
     * @return User|false
     */
    public function findByUsername(string $username)
    {
        $stmt = static::getDb()->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Models\User');
        $stmt->execute([$username]);
        return $results = $stmt->fetch();
    }
}
