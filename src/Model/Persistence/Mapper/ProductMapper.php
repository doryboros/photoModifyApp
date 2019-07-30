<?php


namespace MyApp\Model\Persistence\Mapper;

use MyApp\Model\Persistence\Finder\ProductFinder;
use MyApp\Model\DomainObject\Product;
use MyApp\Model\Persistence\PersistenceFactory;
use PDO;

class ProductMapper extends AbstractMapper
{

    /**
     * @param Product $product
     */
    public function save(Product $product)
    {
        var_dump($product);
        if ($product->getId() === null) {
            $this->insert($product);
            $lastId = $this->getPdo()->lastInsertId();
            $product->setId($lastId);
            $this->insertTags($product);
        } else {
            $this->update($product);
        }
    }

    /**
     * @param Product $product
     * @return bool|\PDOStatement
     */
    private function insert(Product $product)
    {
        $row = $this->translateToArray($product);
        $sql = "INSERT INTO product (title,description,cameraSpecs,captureDate,thumbnailPath,userId) 
                VALUES(:title,:description,:cameraSpecs,:captureDate,:thumbnailPath,:userId)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('title', $row['title']);
        $statement->bindValue('description', $row['description']);
        $statement->bindValue('cameraSpecs', $row['cameraSpecs']);
        $statement->bindValue('captureDate', $row['captureDate']);
        $statement->bindValue('thumbnailPath', $row['thumbnailPath']);
        $statement->bindValue('userId', $row['userId']);
        $statement->execute();
        return $statement;
    }

    private function insertTags(Product $product)
    {
        $row = $this->translateToArray($product);
        foreach ($row['tags'] as $tag) {
            /**
             * @var ProductFinder $findTagName
             */
            $findTagName=PersistenceFactory::createFinder('product');
            $tagId=$findTagName->findTagId($tag);
            $sql="INSERT INTO product_tag (productId,tagId) VALUES (:productId,:tagId)";
            $statement = $this->getPdo()->prepare($sql);
            $statement->bindValue('productId',(int)$product->getId(), PDO::PARAM_INT);
            $statement->bindValue('tagId',(int)$tagId, PDO::PARAM_INT);
            $statement->execute();
        }
    }


    /**
     * @param Product $product
     */
    private function update(Product $product)
    {
        $row = $this->translateToArray($product);
        $sql = "UPDATE product 
                SET title=:title, 
                    description=:description, 
                    cameraSpecs=:cameraSpecs,
                    thumbnailPath=:thumbnailPath,
                    userId=:userId 
                WHERE id=:id";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('title', $row['title']);
        $statement->bindValue('description', $row['description']);
        $statement->bindValue('cameraSpecs', $row['cameraSpecs']);
        $statement->bindValue('captureDate', $row['captureDate']);
        $statement->bindValue('thumbnailPath', $row['thumbnailPath']);
        $statement->bindValue('userId', $row['userId']);
        $statement->execute();
    }

    /**
     * @param Product $domainObject
     * @return array
     */
    public function translateToArray($domainObject): array
    {
        $row = [
            'id'    => $domainObject->getId(),
            'title'  => $domainObject->getTitle(),
            'description' => $domainObject->getDescription(),
            'cameraSpecs'  => $domainObject->getCameraSpecs(),
            'captureDate' => $domainObject->getCaptureDate(),
            'thumbnailPath'  => $domainObject->getThumbnailPath(),
            'tags' => $domainObject->getTags(),
            'userId' => $domainObject->getUserId(),
        ];
        return $row;
    }
}