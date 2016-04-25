<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entity\Attribute;

class ApplicationRepository extends EntityRepository {

	/**
     * @param $id|null
     *
     * @return string
     */
    public function get($id = null) {
        $em = $this->getEntityManager();

        if ($id === null) {
            return $em->find(array(), array('id' => 'ASC'));
        } 
        
        return $em->find('App\Entity\Application', $id);
    }

    /*
    public function put($id) {
        $app   = \Slim\Slim::getInstance();
        $em    = $this->getEntityManager();

        $name  = $app->request()->params('name');
        $email = $app->request()->params('email');

        // handle if $id is missing or $name or $email are valid etc.
        // return valid status code or throw an exception
        // depends on the concrete implementation

        
        $entity = $em->find('App\Entity\Application', $id);
        // also check if $entity has been found else handle correctly

        if(!isset($entity))
            throw new exception("Application not found!");

        $entity->setEmail($email);
        $entity->setName($name);

        $em->persist($entity);
        $em->flush();

        return json_encode($this->convertToArray($entity));
    }
    */

    // POST, PUT, DELETE methods...

    /**
     * @param \App\Entity\Application $entity
     * @return array
     */
    public function convertToArray($entity) {
        return array(
            'id'      => $entity->getId(),
            'name'    => $entity->getName(),
            'special' => $entity->getSpecial()
        );
    }
}