<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributeValueString32
 *
 * @ORM\Table(name="attribute_value_string_32", indexes={@ORM\Index(name="IDX_BC1335C1F22AC81", columns={"id_register"}), @ORM\Index(name="IDX_BC1335C17A4F53DC", columns={"id_attribute"})})
 * @ORM\Entity(repositoryClass="App\Repository\AttributeValueString32Repository")
 */
class AttributeValueString32 extends \App\BaseAbstract\AbstractBaseEntityAttributeValue
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=32, nullable=true)
     */
    protected $value;

    /**
     * Set value
     *
     * @param string|null $value
     *
     * @return AttributeValueString32
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}

