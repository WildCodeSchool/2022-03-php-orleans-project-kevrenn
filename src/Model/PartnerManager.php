<?php

namespace App\Model;

class PartnerManager extends AbstractManager
{
    public const TABLE = 'partner';

    public function insert(array $partner): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (`name`, `url`, `logo_link`) VALUES (:name, :url, :logo_link)"
        );
        $statement->bindValue('name', $partner['name'], \PDO::PARAM_STR);
        $statement->bindValue('url', $partner['url'], \PDO::PARAM_STR);
        $statement->bindValue('logo_link', $partner['logo_link'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $partner): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET `name`=:name,`url`=:url, `logo_link`=:logo_link  WHERE id=:id"
        );
        $statement->bindValue('id', $partner['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $partner['name'], \PDO::PARAM_STR);
        $statement->bindValue('url', $partner['url'], \PDO::PARAM_STR);
        $statement->bindValue('logo_link', $partner['logo_link'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
