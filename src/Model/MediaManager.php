<?php

namespace App\Model;

class MediaManager extends AbstractManager
{
    public const TABLE = 'media';

    public function insert(array $media): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`image`, `event_id`)
        VALUES (:image, :event_id)");
        $statement->bindValue('image', $media['image'], \PDO::PARAM_STR);
        $statement->bindValue('event_id', $media['event.id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    public function selectByEventId(int $eventId)
    {
        $query = 'SELECT * FROM ' . self::TABLE . ' WHERE event_id=:eventId';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('eventId', $eventId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
