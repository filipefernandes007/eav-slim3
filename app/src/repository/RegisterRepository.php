<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Attribute;
use App\Entity\Register;
use App\Entity\Entity;
use Doctrine\ORM\Query;

class RegisterRepository extends EntityRepository {
	
	/**
	 *
	 */
	public function getAttributeValue(Register $register = null, 
									  Attribute $attribute) {
		
		$arrayParams = array('id_attr' => $attribute->getId());
		
		if(!is_null($register)) {
			$arrayParams['id_reg'] = $register->getId();

			$sql = 'SELECT ai, r, a FROM App\Entity\AttributeValue{$entityTypeName} ai ' .
				   'JOIN ai.register r JOIN ai.attribute a ' .
				   'WHERE r.id = :id_reg AND a.id = :id_attr';		  
		} else {
			$sql = 'SELECT ai, r, a FROM App\Entity\AttributeValue{$entityTypeName} ai ' .
				   'JOIN ai.attribute a ' .
				   'WHERE a.id = :id_attr';		  
		}  
				  
		try {
			$query = $this->getEntityManager()->createQuery($sql);
			$query->setParameters($arrayParams);
			$query->setMaxResults(1);

			return $query->getOneOrNullResult(Query::HYDRATE_OBJECT);
		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return null;
	}

	/**
	 * @param int $idState
	 *
	 * @return array|null
	 */
	public function getRegistersByState($idState) {
		$sql	= 'SELECT r FROM App\Entity\Register r JOIN ' .
				  'App\Entity\State s ' .
				  'WITH r.state = s WHERE s.id = :idState';
		try {
			$query  = $this->getEntityManager()->createQuery($sql);
			$query->setParameters(array(
									'idState'    => (int) $idState
								  ));

			return $query->getResult();	

		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return null;		
	}

    /**
     * Get distinct children entity register
     *
     * @param Register $register
     * @return array|null
     */
    public function getChildrenEntity(Register $register) {
        $result = null;

		$sql = 'SELECT DISTINCT e.name AS entityName, e.id AS entityId ' .
               'FROM App\Entity\Entity e JOIN ' .
			   'App\Entity\Register r ' .
			   'WITH r.entity = e ' .
			   'WHERE r.parent = :register ';

		try {

			$query = $this->getEntityManager()->createQuery($sql);
			$query->setParameters(array('register' => $register));	   

			$result = $query->getResult();

            $resultArray = array();

            foreach ($result as $data) {
                $id = $data['entityId'];

                $resultArray[$id]['entity']   = array('id' => $id, 'name' => $data['entityName']);
            }

            $result = $resultArray;

		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return $result;
	}

    /**
     * Get distinct children entity register
     *
     * @param Register $register
     * @return array|null
     */
    public function getChildrenEntityAndRegisters(Register $register) {
        $result = null;

        $sql = 'SELECT COUNT(e.id) AS ce, e.name AS entityName, e.id AS entityId, r.id AS registerId ' .
            'FROM App\Entity\Entity e JOIN ' .
            'App\Entity\Register r ' .
            'WITH r.entity = e ' .
            'WHERE r.parent = :register ' .
            'GROUP BY e.id, r.id';

        try {

            $query = $this->getEntityManager()->createQuery($sql);
            $query->setParameters(array('register' => $register));

            $result = $query->getResult();

            $resultArray = array();

            foreach ($result as $data) {
                $id = $data['entityId'];

                if (isset($resultArray[$id])) {
                    $resultArray[$id]['registers'][] = $data['registerId'];
                } else {
                    $resultArray[$id]['entity']   = array('id' => $id, 'name' => $data['entityName']);
                    $resultArray[$id]['registers'] = array($data['registerId']);
                }

            }

            $result = $resultArray;
        } catch (\Exception $e) {
            print($e->getMessage());
        }

        return $result;
    }

	/**
	 *
     * @param \App\Entity\Register $register
     *
     * @return array|null 
	 */
	public function getEntityAttributesHeader(Register $register) {
		$rsm = new Query\ResultSetMapping();
		$rsm->addEntityResult('App\Entity\Attribute', 'a');

		$sql = 'SELECT a.* FROM tbl_attribute a ' .
				'WHERE a.id_entity IN ' .
				'(SELECT DISTINCT rc.id_entity FROM tbl_register rc ' .
				'LEFT JOIN tbl_register rp ' .
				'ON rc.id_parent = rp.id ' .
				'WHERE rp.id = :id_register) ';
		try {
			$params['id_register'] = $register->getId();
			$stmt = $this->getEntityManager()
						 ->getConnection()
						 ->prepare($sql);

			$stmt->execute($params);
			$result = $stmt->fetchAll(); 			 
			
			return $result;
		} catch (\Exception $e) {
			print($e->getMessage());
		}
	}

	/**
	 *
     * @param \App\Entity\Register $register
     *
     * @return array|null 
	 */
	public function getChildrenEntities(Register $register) {
		$entities = array();

		foreach ($register->getChildren() as $child) {
			$entities[] = $child->getEntity();	
		}

		return $entities;
	}

	/**
	 *
	 */
	public function getChildrenEntitiesAttributes(Register $register) {
		$result   = array();
		$entities = $this->getChildrenEntities($register);

        /**
         * @var SystemEntityRepository $repo
         */
        $repo = $this->getEntityManager()
				     ->getRepository('App\Entity\Entity');

        /**
         * @var Entity $entity
         */
        foreach ($entities as $entity) {
			$result[$entity->getId()] = $repo->getEntityAttributesArray($entity);
		}

		return $result;
	}

	public function convertToArray($entity) {
		return array(
            'id' 		=> $entity->getId(),
            'parent' 	=> $entity->getParent(),
            'children' 	=> $entity->getChildren(),
            'entity'	=> $entity->getEntity()
        );
	}
}