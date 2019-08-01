<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObject\User;
use PDO;

class UserFinder extends AbstractFinder
{
    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        $sql = "select * from user where id=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->translateToUser($row);
    }

    /**
     * @param $email
     * @param $password
     * @return User|null
     */
    public function findByCredentials($email, $password)
    {
        $sql = "select * from user where email=:email";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('email',$email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!password_verify(trim($password), trim($row['password']))) {
            return null;
        }
        return $this->translateToUser($row);
    }

    /**
     * @param $row
     * @return User
     */
    private function translateToUser($row): User
    {
        $user = new User($row['id'], $row['name'], $row['email'],null);

        return $user;
    }
}