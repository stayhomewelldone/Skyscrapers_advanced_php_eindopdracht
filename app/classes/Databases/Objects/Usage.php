<?php

namespace Buildings\Databases\Objects;

use Buildings\Databases\BaseObject;

/**
 * Class Usage
 * @package Buildings\Databases\Objects
 * @method static Usage[] getAll()
 * @method static Usage getById(int $id)
 */
class Usage extends BaseObject
{
    protected static string $table = 'usages';

    public ?int $id = null;
    public string $name = '';

    /**
     * As Usage is used on many-to-many related scenarios, we need a simple string when printing the object
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Skyscraper[]
     */
    public function skyscrapers(): array
    {
        $statement = $this->db->prepare(
            "SELECT al.* FROM `skyscrapers` AS al
                    LEFT JOIN skyscraper_usage ag ON al.id = ag.skyscraper_id
                    LEFT JOIN usages g on ag.usage_id = g.id
                    WHERE `g`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'Buildings\Databases\Objects\Skyscraper');
    }
}
