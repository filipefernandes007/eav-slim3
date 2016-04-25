<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use App\Entity\AttributeValueInt as AttributeValueInt;
use App\Entity\Attribute as Attribute;
use App\Entity\Register as Register;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query as Query;

class AttributeValueIntRepository extends EntityRepository {
	
	/**
	 *
	 */
	public function getAttributeValue(Register $register = null, 
									  Attribute $attribute) {
		
		$arrayParams = array('id_attr' => $attribute->getId());
		
		if(!is_null($register)) {
			$arrayParams['id_reg'] = $register->getId();

			$sql = 'SELECT ai, r, a FROM App\Entity\AttributeValueInt ai ' .
				   'JOIN ai.register r JOIN ai.attribute a ' .
				   'WHERE r.id = :id_reg AND a.id = :id_attr';
		} else {
			$sql = 'SELECT ai, a FROM App\Entity\AttributeValueInt ai ' .
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

	public function convertToArray(AttributeValueInt $entity) {
		return array(
            'id' 		=> $entity->getId(),
            'value' 	=> $entity->getValue(),
            'register'	=> $entity->getRegister(),
            'attribute' => $entity->getAttribute()
        );
	}
}