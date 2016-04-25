<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entity\Attribute;

class AttributeRepository extends EntityRepository {
	public function findMethod() {
		die("In Attribute Repository");
	}

	public function convertToArray(Attribute $attribute) {
		return array(
            'id' 		=> $attribute->getId(),
            'name' 		=> $attribute->getName(),
            'entity' 	=> $attribute->getEntity(),
            'type'		=> $attribute->getType(),
            'size'		=> $attribute->getSize(),
            'inline'	=> $attribute->getInline(),
            'css'		=> $attribute->getCss()
        );
	}

}