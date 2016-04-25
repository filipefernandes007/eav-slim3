<?php


namespace App\BaseAbstract;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\MappedSuperClass
 */ 
abstract class AbstractBaseEntity {
	/**
	 * @var integer
	 *
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @param int $id
	 *
	 */
	protected function setId($id) {
	    $this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId() {
	    return $this->id;
	}
}

