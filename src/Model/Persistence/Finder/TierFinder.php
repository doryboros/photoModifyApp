<?php


namespace MyApp\Model\Persistence\Finder;

use MyApp\Model\DomainObject\Tier;
use PDO;

class TierFinder extends AbstractFinder
{
    /**
     * @param int $productId
     * @return array
     */
    public function findAllTiersByProductId(int $productId):array
    {
        $sql="select * from tier where productId=?";
        $statement=$this->getPdo()->prepare($sql);
        $statement->bindValue(1,$productId);
        $statement->execute();
        $rows=$statement->fetchAll(PDO::FETCH_ASSOC);
        $tiersArray=[];
        foreach($rows as $tierItem){
            $tier= new Tier(
                            $tierItem['size'],
                            $tierItem['price'],
                            $tierItem['patWithWatermark'],
                            $tierItem['pathWithoutWatermark'],
                            $tierItem['productId'],
                            $tierItem['id']
            );
            $tiersArray[] = $tier;
        }
        return $tiersArray;
    }

    /**
     * @param int $id
     * @return Tier
     */
    public function getById(int $id)
    {
        $sql="SELECT * FROM tier WHERE id=?";
        $statement=$this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        $rows=$statement->fetch(PDO::FETCH_ASSOC);
        $tier = new Tier(
                        $rows['size'],
                        $rows['price'],
                        $rows['patWithWatermark'],
                        $rows['pathWithoutWatermark'],
                        $rows['productId'],
                        $rows['id']
        );
        return $tier;
    }
}