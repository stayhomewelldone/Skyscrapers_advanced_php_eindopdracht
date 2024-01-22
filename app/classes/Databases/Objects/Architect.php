<?php

namespace Buildings\Databases\Objects;

use Buildings\Databases\BaseObject;

/**
 * Class Architect
 * @package Buildings\Databases\Objects
 * @method static Architect[] getAll()
 * @method static Architect getById(int $id)
 */
class Architect extends BaseObject
{
    protected static string $table = 'architects';
    protected static array $joinForeignKeys = [
        'user_id' => [
            'table' => 'users',
            'object' => 'Buildings\Databases\Objects\User'
        ]
    ];

    public ?int $id = null;
    public ?int $user_id = null;
    public string $name = '';

    /**
     * @return Skyscraper[]
     */
    public function skyscrapers(): array
    {
        $statement = $this->db->prepare(
            "SELECT al.* FROM `skyscrapers` AS al
                    LEFT JOIN architects ar ON ar.id = al.architect_id
                    WHERE `ar`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'Buildings\Databases\Objects\Skyscraper');
    }
}
