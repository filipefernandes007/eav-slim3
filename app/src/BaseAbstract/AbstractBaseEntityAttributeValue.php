<?php

namespace App\BaseAbstract;

use Doctrine\ORM\Mapping AS ORM;
use App\Entity\Register as Register;
use App\Entity\Attribute as Attribute;

/**
 * @ORM\MappedSuperclass
 */ 
abstract class AbstractBaseEntityAttributeValue extends \App\BaseAbstract\AbstractBaseEntity {
	
	/**
     * @var \App\Entity\Register
     *
     * @ORM\ManyToOne(targetEntity="Register")
     * @ORM\JoinColumn(name="id_register", referencedColumnName="id")
     */
    protected $register;

    /**
     * @var \App\Entity\Attribute
     *
     * @ORM\ManyToOne(targetEntity="Attribute")
     * @ORM\JoinColumn(name="id_attribute", referencedColumnName="id")
     */
    protected $attribute;

    /**
     * @ORM\Column(name="value")
     */
    protected $value;

	/**
	 * @return \App\Entity\Register 
	 */
	public function getRegister() {
        return $this->register;
    }

    /**
	 * @return \App\Entity\Attribute
	 */
    public function getAttribute() {
        return $this->attribute;
    }

    /**
     * @return string|int|null
     */
    public function getValue() {
        return $this->value;
    }

	/**
	 * @param int|string|null $value
	 *
	 */
	public function setValue($value = null) {
    	$this->value = $value;
	}

	/**
	 * @param \App\Entity\Register $register
	 */
	public function setRegister(Register $register) {
		$this->register = $register;
	}

	/**
	 * @param \App\Entity\Attribute $attribute
	 */
	public function setAttribute(Attribute $attribute) {
		$this->attribute = $attribute;
	}
}
