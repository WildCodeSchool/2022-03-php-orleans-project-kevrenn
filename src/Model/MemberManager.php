<?php

namespace App\Model;

class MemberManager extends AbstractManager
{
    public const TABLE = 'member';

    public function update(array $member): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET `name`=:name,`status`=:status, `photo_link`=:photo_link WHERE id=:id"
        );
        $statement->bindValue('id', $member['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $member['name'], \PDO::PARAM_STR);
        $statement->bindValue('status', $member['status'], \PDO::PARAM_STR);
        $statement->bindValue('photo_link', $member['photo_link'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function insert(array $member): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " (`name`, `status`, `photo_link`) VALUES (:name, :status, :photo_link)"
        );
        $statement->bindValue('name', $member['name'], \PDO::PARAM_STR);
        $statement->bindValue('status', $member['status'], \PDO::PARAM_STR);
        $statement->bindValue('photo_link', $member['photo_link'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
