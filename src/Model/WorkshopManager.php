<?php

namespace App\Model;

class WorkshopManager extends AbstractManager
{
    public const TABLE = 'workshop';

    public function update(array $workshop): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name`=:name,`description`=:description, `address`=:address, `date`=:date  WHERE id=:id");
        $statement->bindValue('id', $workshop['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $workshop['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $workshop['description'], \PDO::PARAM_STR);
        $statement->bindValue('address', $workshop['address'], \PDO::PARAM_STR);
        $statement->bindValue('date', $workshop['date']);

        return $statement->execute();
    }
}
