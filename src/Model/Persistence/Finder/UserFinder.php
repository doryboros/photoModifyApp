<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObject\User;
use PDO;

class UserFinder extends AbstractFinder
{
    public function findById(int $id): User
    {
        $sql = "select * from user where id=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->translateToUser($row);
    }

    private function translateToUser($row): User
    {
        $user = new User($row['id'], $row['name'], $row['email'],null);

        return $user;
    }
}