<?php


namespace MyApp\Model\Persistence;

use MyApp\Model\Persistence\Finder\AbstractFinder;
use MyApp\Model\Persistence\Mapper\AbstractMapper;
use PDO;

class PersistenceFactory
{
    private static $mappers = [];

    private static $finders = [];

    private static $pdo;

    /**
     * Returns PDO instance to use in mappers and finders.
     *
     * @return PDO
     */
    private static function createPdo()
    {
        // we ensure we create a single connection per request
        if (self::$pdo === null) {
            // taking config from global variable: not pretty but for now does the job
            global $config;
            self::$pdo = new PDO($config['dsn'], $config['user'], $config['password']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }

    /**
     * Entity mapper factory
     *
     * @param string $entityClass
     *
     * @return AbstractMapper
     */
    public static function createMapper(string $entityClass): AbstractMapper
    {
        $mapperClass = self::getMapperClassName($entityClass);
        // we ensure we create a single mapper instance of this type per request
        if (!isset(self::$mappers[$mapperClass])) {
            self::$mappers[$mapperClass] = new $mapperClass(self::createPdo());
        }
        return self::$mappers[$mapperClass];
    }

    /**
     * Entity finder factory
     *
     * @param string $entityClass
     *
     * @return AbstractFinder
     */
    public static function createFinder(string $entityClass): AbstractFinder
    {
        $finderClass = self::getFinderClassName($entityClass);
        // we ensure we create a single finder instance of this type per request
        if (!isset(self::$finders[$finderClass])) {
            self::$finders[$finderClass] = new $finderClass(self::createPdo());
        }
        return self::$finders[$finderClass];
    }

    private static function getMapperClassName(string $entityClass): string
    {
        // TODO: transform by convention an entity class name to its mapper class name
        return 'MyApp\\Model\\Persistence\\Mapper\\'.mb_convert_case($entityClass, MB_CASE_TITLE)."Mapper";
    }


    private static function getFinderClassName(string $entityClass): string
    {
        // TODO: transform by convention an entity class name to its mapper class name
        return 'MyApp\\Model\\Persistence\\Finder\\'.mb_convert_case($entityClass, MB_CASE_TITLE)."Finder";
    }
}