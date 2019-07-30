<?php


namespace MyApp\Model\Persistence\Finder;

use MyApp\Model\DomainObject\Product;
use PDO;

class ProductFinder extends AbstractFinder
{
    public function findById(int $id): Product
    {
        $sql = "select * from product where id=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->translateToProduct($row);
    }

    public function findAllProducts(): array
    {
        $sql = "select * from product";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();
        $result = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //$tags = $this->findProductTags($row['id']);
            $row['tags'] = ['animal', 'doi tag'];
            $result[] = $this->translateToProduct($row);
        }

//        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function findTagId(string $tag)
    {
        $sql = "select id from tag where tagName=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $tag, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }

    private function translateToProduct($row): Product
    {
        $product = Product::createFromRow($row);

        return $product;
    }
}