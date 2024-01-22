<?php

namespace Buildings\Databases\Objects;

use Buildings\Databases\BaseObject;
use Buildings\Databases\Database;

/**
 * Class User
 * @package Buildings\Databases\Objects
 * @method static User[] getAll()
 * @method static User getById($id)
 */
class User extends BaseObject
{
    protected static string $table = 'users';

    public ?int $id = null;
    public string $email = '';
    public ?string $password = '';
    public string $name = '';

    /**
     * Get a specific user by its email
     *
     * @param string $email
     * @return User
     * @throws \Exception
     */
    public static function getByEmail(string $email): User
    {
        $db = Database::getInstance();
        $statement = $db->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute([':email' => $email]);

        if (($user = $statement->fetchObject(get_called_class())) === false) {
            throw new \Exception('User email is not available in the database');
        }

        return $user;
    }
}
