<?php

namespace App\Model;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';

    public function insert(array $event): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (`name`, `date`, `description`, `address`, `image_link`)
        VALUES (:name, :date, :description, :address, :image_link)");
        $statement->bindValue('name', $event['name'], \PDO::PARAM_STR);
        $statement->bindValue('date', $event['date'], \PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], \PDO::PARAM_STR);
        $statement->bindValue('address', $event['address'], \PDO::PARAM_STR);
        $statement->bindValue('image_link', $event['image_link'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
