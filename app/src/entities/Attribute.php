<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Entity as Entity;
use App\Entity\Type as Type;

/**
 * Attribute
 *
 * @ORM\Table(name="attribute", indexes={@ORM\Index(name="IDX_BFF28068281FF185", columns={"id_entity"}), @ORM\Index(name="IDX_BFF280687FE4B2B", columns={"id_type"})})
 * @ORM\Entity
 */
class Attribute
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    private $order = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    private $size;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inline", type="boolean", nullable=false)
     */
    private $inline = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="css", type="string", length=255, nullable=false)
     */
    private $css = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description = '';

    /**
     * @var \App\Entity\Entity
     *
     * @ORM\ManyToOne(targetEntity="Entity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_entity", referencedColumnName="id")
     * })
     */
    private $entity;

    /**
     * @var \App\Entity\Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $type;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return Attribute
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return Attribute
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set inline
     *
     * @param boolean $inline
     *
     * @return Attribute
     */
    public function setInline($inline)
    {
        $this->inline = $inline;

        return $this;
    }

    /**
     * Get inline
     *
     * @return boolean
     */
    public function getInline()
    {
        return $this->inline;
    }

    /**
     * Set css
     *
     * @param string $css
     *
     * @return Attribute
     */
    public function setCss($css)
    {
        $this->css = $css;

        return $this;
    }

    /**
     * Get css
     *
     * @return string
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Attribute
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set entity
     *
     * @param \App\Entity\Entity $entity
     *
     * @return Attribute
     */
    public function setEntity(Entity $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get Entity
     *
     * @return \App\Entity\Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set type
     *
     * @param \App\Entity\Type $type
     *
     * @return Attribute
     */
    public function setType(Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }
}

