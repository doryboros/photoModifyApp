<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObject\OrderItem;


class OrderMapper extends AbstractMapper
{
    /**
     * @param OrderItem $order
     * @return string
     */
    public function save(OrderItem $order)
    {
        if ($order->getId() === null) {
            $this->insert($order);
            $lastId = $this->getPdo()->lastInsertId();
            $order->setId($lastId);
            return $lastId;
        }
        $this->update($order);
    }


    /**
     * @param OrderItem $order
     */
    private function insert(OrderItem $order)
    {
        $row = $this->translateToArray($order);
        $sql = "INSERT INTO orderItem (userId, tierId) 
                VALUES(:userId, :tierId)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('userId', $row['userId']);
        $statement->bindValue('tierId', $row['tierId']);
        $statement->execute();
    }

    /**
     * @param $domainObject
     * @return array
     */
    public function translateToArray($domainObject): array
    {
        $row = [
            'userId'    => $domainObject->getUserId(),
            'tierId'  => $domainObject->getTierId()
        ];
        return $row;
    }
}