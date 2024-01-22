<?php

namespace Buildings\Databases\Objects;

use Buildings\Databases\BaseObject;
use Buildings\Databases\Database;

/**
 * Class Skyscraper
 * @package Buildings\Databases\Objects
 * @method static Skyscraper[] getAll()
 * @method static Skyscraper getById($id)
 */
class Skyscraper extends BaseObject
{
    protected static string $table = 'skyscrapers';
    protected static array $joinForeignKeys = [
        'architect_id' => [
            'table' => 'architects',
            'object' => 'Buildings\Databases\Objects\Architect'
        ],
        'user_id' => [
            'table' => 'users',
            'object' => 'Buildings\Databases\Objects\User'
        ]
    ];

    public ?int $id = null;
    public ?int $user_id = null;
    public ?int $architect_id = null;
    public string $name = '';
    public string $built_year = '';
    public int $floors = 0;
    public string $image = '';
    private array $usageIds = [];

    /**
     * @return bool
     */
    public function saveUsages(): bool
    {
        try {
            $this->db->beginTransaction();

            //Delete all current references
            $statement = $this->db->prepare('DELETE FROM skyscraper_usage WHERE skyscraper_id = :skyscraper_id');
            $statement->execute([':skyscraper_id' => $this->id]);

            //Add the current references
            foreach ($this->usageIds as $usageId) {
                $statement = $this->db->prepare('INSERT INTO skyscraper_usage (usage_id, skyscraper_id) VALUES (:usage_id, :skyscraper_id)');
                $statement->execute([
                    ':usage_id' => $usageId,
                    ':skyscraper_id' => $this->id
                ]);
            }
            $this->db->commit();
            return true;
        } catch (\PDOException) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * @return Usage[]
     */
    public function getUsages(): array
    {
        $statement = $this->db->prepare(
            'SELECT g.* FROM usages AS g
                    LEFT JOIN skyscraper_usage ag ON g.id = ag.usage_id
                    LEFT JOIN skyscrapers a on ag.skyscraper_id = a.id
                    WHERE a.id = :skyscraper_id'
        );
        $statement->execute([':skyscraper_id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, '\Buildings\Databases\Objects\Usage');
    }

    /**
     * @return array
     */
    public function getUsageIds(): array
    {
        return $this->usageIds;
    }

    /**
     * @param array $usageIds
     * @return void
     */
    public function setUsageIds(array $usageIds): void
    {
        $this->usageIds = $usageIds;
    }
}
