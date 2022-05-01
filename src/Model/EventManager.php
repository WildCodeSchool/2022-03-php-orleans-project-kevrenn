<?php

namespace App\Model;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';

    public function insert(array $event): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $event['title'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $event): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $event['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $event['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
