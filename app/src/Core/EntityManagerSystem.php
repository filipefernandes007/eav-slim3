<?php
/**
 * Created by PhpStorm.
 * User: Filipe
 * Date: 21/12/15
 * Time: 05:41
 */

namespace App\Core;

use App\Resource\System\GenericResource as Resource;


class EntityManagerSystem {
    /**
     * @var \App\Core\EntityManagerSystem
     */
    private static $instance = null;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private static $em;

    private function __construct () { }

    /**
     * @return \App\Core\EntityManagerSystem
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;

            $resource = new Resource();
            self::$em = $resource->getEntityManager();
        }

        return self::$instance;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return self::$em;
    }
} 