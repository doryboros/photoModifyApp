<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObject\User;
Use PDO;

class UserMapper extends AbstractMapper
{
    /**
     * @param User $user
     */
    public function save(User $user)
    {
        if ($user->getId() === null) {
            $this->insert($user);
            return;
        }

        $this->update($user);
    }

    /**
     * @param User $user
     */
    private function insert(User $user)
    {
        $row = $this->translateToArray($user);
        $sql = "INSERT INTO user (name,email,password) VALUES(:name,:email,:password)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('name', $row['name']);
        $statement->bindValue('email', $row['email']);
        $statement->bindValue('password',$row['password']);
        $statement->execute();
    }

    /**
     * @param User $user
     */
    private function update(User $user)
    {
        //TODO: transform user to array row then prepare an UPDATE ($this->getPdo()) and execute
        $row = $this->translateToArray($user);
        $sql = "UPDATE user SET name=:name, email=:email, password=:password WHERE id=:id";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('name', $row['name']);
        $statement->bindValue('email', $row['email']);
        $statement->bindValue('password', $row['password']);
        $statement->bindValue('id', $row['id']);
        $statement->execute();
    }

    /**
     * @param User $user
     * @return array
     */
    public function translateToArray($user): array
    {
        // TODO: you may extract this array to a constant in this class, the app config, or you can use reflection
        // to obtain all the properties of user dynamically then by convention obtain the columns to map to (next level)
        $row = [
            'id'    => $user->getId(),
            'name'  => $user->getName(),
            'email' => $user->getEmail(),
        ];

        // write password only when is set/user is a new entity (on load it is never read into the property)
        if ($user->getPassword() !== null) {
            $row['password'] = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        }

        return $row;
    }
}