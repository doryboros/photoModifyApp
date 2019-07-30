<?php


namespace MyApp\Model\Persistence\Mapper;


use PDO;

abstract class AbstractMapper
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * AbstractMapper constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return PDO
     */
    protected function getPdo(): PDO
    {
        return $this->pdo;
    }

    // TODO extract here what else is common to all mappers

    /**
     * @param $domainObject
     * @return array
     */
    public abstract function translateToArray($domainObject) : array;
}