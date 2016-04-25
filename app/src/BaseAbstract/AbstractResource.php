<?php

/**
 * Created by PhpStorm.
 * User: Filipe
 * Date: 10/10/15
 * Time: 10:10
 */

namespace App\BaseAbstract;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class AbstractResource {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;
    
    /**
     * @var string
     */
    protected $entityNamespace;

    /**
     * @var string
     */
    protected $lastSqlQuery;

    /**
     * @var array
     */
    private $connectionOptions;

    /**
     * @return EntityManager
     */
    public function createEntityManager() {
        //$path = array(dirname(__DIR__) . '/Entity/System');
        $path = array(dirname(__DIR__) . '/SystemBundle/Entity');

        // define credentials...
        if(is_null($this->connectionOptions)) {
            $config = include(dirname(__DIR__) . '/../config/config.php');
            $this->connectionOptions = $config['database'];
        }

        $setup  = Setup::createAnnotationMetadataConfiguration($path, $this->connectionOptions['dev-mode']);

        return EntityManager::create($this->connectionOptions, $setup);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * @param string $entityNamespace
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($entityNamespace = null) {
        if(empty($entityNamespace))
            $entityNamespace = $this->entityNamespace;

        return $this->getEntityManager()
                    ->getRepository($entityNamespace);
    }

    /**
     * @return null|object
     */
    public function find($id) {
        return $this->getEntityManager()
                    ->find($this->entityNamespace, $id);
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function getById($id) {
        $entity = $this->getEntityManager()
                       ->getRepository($this->entityNamespace)
                       ->find($id);

        return $entity;
    }

    /**
     * @return array
     */
    public function getAll() {
        $entities = $this->getEntityManager()
                         ->getRepository($this->entityNamespace)
                         ->findAll();

        return $entities;
    }

    /**
     *
     */
    public function getAllJson() {
        $entities = $this->getAll($this->entityNamespace);

        $mapping  = array_map(function($entity) {
            return $this->convertToArray($entity);
        }, $entities);

        return json_encode($mapping);
    }

    public function getByIdJson($id) {
        $entity = $this->getEntityManager()
                       ->getRepository($this->entityNamespace)
                       ->find($id);

        $_instance = new $this->entityNamespace();

        if(!is_null($entity) && $entity instanceof $_instance) {
            $data = $this->convertToArray($entity);

            return json_encode($data);
        }

        return \Core\Message::send("Entity Not Found!");       
    }

    public function setEntity($e) {
        $this->entityNamespace = $e;

        return $this;
    }

    public function jsonEncode($e) {
        return json_encode($this->convertToArray($e));
    }

    public function getLastSqlQuery() {
        
    }

    abstract public function convertToArray($entity);
}