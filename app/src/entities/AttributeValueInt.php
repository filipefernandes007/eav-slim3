<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributeValueInt
 *
 * @ORM\Table(name="attribute_value_int", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_register_value_int", columns={"id_register", "id_attribute"})}, indexes={@ORM\Index(name="idx_register_attribute", columns={"id_register", "id_attribute"}), @ORM\Index(name="IDX_C52E99F57A4F53DC", columns={"id_attribute"}), @ORM\Index(name="IDX_FA8520DBF22AC81", columns={"id_register"})})
 * @ORM\Entity(repositoryClass="App\Repository\AttributeValueIntRepository")
 */
class AttributeValueInt extends \App\BaseAbstract\AbstractBaseEntityAttributeValue
{
    
    /**
     * Set value
     *
     * @param integer|null $value
     *
     * @return AttributeValueInt
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }
   
}

