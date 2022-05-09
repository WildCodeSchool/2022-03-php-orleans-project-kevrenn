<?php

namespace App\Model;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';


    public function update(array $event): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `name`= :name,`date`=:date, `description` = :description,
        `address` = :address, `image_link` = :image_link WHERE id=:id");
        $statement->bindValue('id', $event['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $event['name'], \PDO::PARAM_STR);
        $statement->bindValue('date', $event['date'], \PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], \PDO::PARAM_STR);
        $statement->bindValue('address', $event['address'], \PDO::PARAM_STR);
        $statement->bindValue('image_link', $event['image_link'], \PDO::PARAM_STR);


        return $statement->execute();
    }
}
