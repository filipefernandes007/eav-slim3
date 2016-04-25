<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributeValueString256
 *
 * @ORM\Table(name="attribute_value_string_256", indexes={@ORM\Index(name="IDX_BFE467F7F22AC81", columns={"id_register"}), @ORM\Index(name="IDX_BFE467F77A4F53DC", columns={"id_attribute"})})
 * @ORM\Entity(repositoryClass="App\Repository\AttributeValueString256Repository")
 */
class AttributeValueString256 extends \App\BaseAbstract\AbstractBaseEntityAttributeValue
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=256, nullable=true)
     */
    protected $value;

    /**
     * Set value
     *
     * @param string|null $value
     *
     * @return AttributeValueString256
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

