<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entity\Attribute;
use App\Entity\Entity;

class SystemEntityRepository extends EntityRepository {

	/**
	 * @param \App\Entity\Entity $entity
	 *
	 * @return array
	 */
	public function getAttributesByOrder(Entity $entity) {
		$result = array();

		$sql	= 'SELECT a FROM App\Entity\Attribute a ' .
				  'JOIN App\Entity\Entity e ' .
				  'WITH a.entity = :entity ' .
				  'ORDER BY a.order ASC';
		try {
			$query  = $this->getEntityManager()->createQuery($sql);
			$query->setParameters(array('entity' => $entity));
			
			$result = $query->getResult();	
			
		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return $result;
	}

	/**
	 * @param \App\Entity\Entity $entity
	 * @param string 					$attributeName
	 *
	 * @return \App\Entity\Attribute|null
	 */
	public function getAttributeByName(Entity $entity, $attributeName) {
		$sql = 'SELECT a FROM App\Entity\Attribute a JOIN ' .
			   'App\Entity\Entity e ' .
			   'WHERE e.id = :id AND a.name = :name ' .
			   'ORDER BY a.order ASC';
		try {
			$query  = $this->getEntityManager()->createQuery($sql);
			$query->setParameters(array(
									'id'   => (int) $entity->getId(),
									'name' => "{$attributeName}"
								  ));

			$result = $query->getResult();	

			if(sizeof($result) > 0) {
				return $result[0];
			}
		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return null;		
	}

	/**
	 * @param int $id_entity
	 * @param int $id_attribute
	 *
	 * @return \App\Entity\Attribute|null 
	 */
	public function getAttributeById($id_entity, $id_attribute) {
		$sql = 'SELECT a FROM App\Entity\Attribute a JOIN ' .
			   'App\Entity\Entity e ' .
			   'WHERE e.id = :id_entity AND a.id = :id_attribute ' .
			   'ORDER BY a.order ASC';
		try {
			$query  = $this->getEntityManager()->createQuery($sql);
			$query->setParameters(array(
									'id_entity'    => (int) $id_entity,
									'id_attribute' => (int) $id_attribute
								  ));

			$result = $query->getResult();	

			if(sizeof($result) > 0) {
				return $result[0];
			}
		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return null;		
	}

	/**
	 * @param int $id_entity
	 *
	 * @return array|null 
	 */
	public function getRegistersByEntity($id_entity) {
		$sql = 'SELECT r FROM App\Entity\Register r JOIN ' .
			   'App\Entity\Entity e ' .
			   'WITH r.entity = e WHERE e.id = :id_entity';
		try {
			$query  = $this->getEntityManager()->createQuery($sql);
			$query->setParameters(array(
									'id_entity' => (int) $id_entity
								  ));

			return $query->getResult();	

		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return null;		
	}

	/**
	 * @param \App\Entity\Entity $entity
	 * 
	 * @return array 
	 */
	public function getEntityAttributesArray(Entity $entity) {
		$array = array();

        $repo  = $this->getEntityManager()
        			  ->getRepository('App\Entity\Attribute');
        
        foreach ($this->getAttributesByOrder($entity) as $attribute) {
            $array[] = $repo->convertToArray($attribute);
        }
    
		return $array;
	}

	/**
	 * @param \App\Entity\Entity $entity
	 *
	 * @return array
	 */
	public function convertToArray($entity) {
		return array(
            'id' 			=> $entity->getId(),
            'name'			=> $entity->getName(),
            'attributes'	=> $entity->getAttributes()
        );
	}
}