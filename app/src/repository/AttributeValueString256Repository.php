<?php

namespace App\Repository;

use App\Entity\Attribute;
use App\Entity\AttributeValueString256;
use App\Entity\Register;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query as Query;

class AttributeValueString256Repository extends EntityRepository {
	
	public function getAttributeValue(Register $register = null,
									  Attribute $attribute) {

		$arrayParams = array('id_attr' => $attribute->getId());

		if(!is_null($register)) {
			$arrayParams['id_reg'] = $register->getId();

			$sql = 'SELECT ai, r, a FROM App\Entity\AttributeValueString256 ai ' .
				   'JOIN ai.register r JOIN ai.attribute a ' .
				   'WHERE r.id = :id_reg AND a.id = :id_attr';		  
		} else {
			$sql = 'SELECT ai, r, a FROM App\Entity\AttributeValueString256 ai ' .
				   'JOIN ai.attribute a ' .
				   'WHERE a.id = :id_attr';		  
		}  
				  
		try {
			$query = $this->getEntityManager()->createQuery($sql);
			$query->setParameters($arrayParams);
			$query->setMaxResults(1);

			//var_dump($query->getSQL(), $query->getParameters());die;

			return $query->getOneOrNullResult(Query::HYDRATE_OBJECT);
		} catch (\Exception $e) {
			print($e->getMessage());
		}

		return null;
	}

	public function convertToArray(AttributeValueString256 $entity) {
		return array(
            'id' 		=> $entity->getId(),
            'value' 	=> $entity->getValue(),
            'register'	=> $entity->getRegister(),
            'attribute' => $entity->getAttribute()
        );
	}
}