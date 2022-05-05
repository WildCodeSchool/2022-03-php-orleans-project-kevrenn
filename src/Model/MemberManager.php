<?php

namespace App\Model;

class MemberManager extends AbstractManager
{
    public const TABLE = 'member';

    public function update(array $member): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name`=:name,`status`=:status  WHERE id=:id");
        $statement->bindValue('id', $member['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $member['name'], \PDO::PARAM_STR);
        $statement->bindValue('status', $member['status'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function insert(array $member): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `status`) VALUES (:name, :status)");
        $statement->bindValue('name', $member['name'], \PDO::PARAM_STR);
        $statement->bindValue('status', $member['status'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
