<?php


namespace MyApp\Model\Persistence\Mapper;

use MyApp\Model\DomainObject\Tier;
use PDO;


class TierMapper extends AbstractMapper
{

    /**
     * @param Tier $tier
     * @return string
     */
    public function save(Tier $tier)
    {
        if (null === $tier->getId()) {
            $this->insert($tier);
            $lastId = $this->getPdo()->lastInsertId();
            $tier->setId($lastId);
            return $lastId;
        }
        $this->update($tier);
    }

    /**
     * @param Tier $tier
     */
    private function insert(Tier $tier)
    {
        $row=$this->translateToArray($tier);
        $sql = "insert into tier(price, patWithWatermark, pathWithoutWatermark,size,productId) 
                values (:price,:patWithWatermark,:pathWithoutWatermark,:size,:productId)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('price',$row['price']);
        $statement->bindValue('patWithWatermark',$row['pathWithWatermark']);
        $statement->bindValue('pathWithoutWatermark',$row['pathWithoutWatermark']);
        $statement->bindValue('size', $row['size']);
        $statement->bindValue('productId', $row['productId']);
        $statement->execute();
    }

    /**
     * @param $domainObject
     * @return array
     */
    public function translateToArray($domainObject): array
    {
        $row = [
            'price'    => $domainObject->getPrice(),
            'pathWithWatermark'  => $domainObject->getPathWithWatermark(),
            'pathWithoutWatermark' => $domainObject->getPathWithoutWatermark(),
            'size'  => $domainObject->getSize(),
            'productId' => $domainObject->getProductId(),

        ];
        return $row;
    }

}