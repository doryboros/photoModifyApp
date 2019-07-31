<?php


namespace MyApp\Model\Persistence\Finder;

use MyApp\Model\DomainObject\Product;
use PDO;

class ProductFinder extends AbstractFinder
{
    public function findById(int $id): Product
    {
        $sql = "select *, (select group_concat(tagName) from tag where id in (select tagId from product_tag where productId = ?)) as tags from product where id = ?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->bindValue(2, $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->translateToProduct($row);
    }

    public function findAllProducts(): array
    {
        $sql = "select product.*, group_concat(tagName) as tags 
                    from product 
                    inner join product_tag on product.id = product_tag.productId 
                    inner join tag on product_tag.tagId = tag.id 
                    group by product.id";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();
        $result = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->translateToProduct($row);
        }

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