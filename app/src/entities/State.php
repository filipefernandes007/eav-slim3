<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Entity as Entity;
use App\Entity\Module as Module;

/**
 * State
 *
 * @ORM\Table(name="state", indexes={@ORM\Index(name="IDX_DF798E4281FF185", columns={"id_entity"}), @ORM\Index(name="FK_state_module", columns={"id_module"})})
 * @ORM\Entity
 */
class State
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
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=64, nullable=false)
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
     * @var \App\Entity\Module
     *
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     * })
     */
    private $module;


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
     * @return State
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
     * Set description
     *
     * @param string $description
     *
     * @return State
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
     * Set Entity
     *
     * @param \App\Entity\Entity $entity
     *
     * @return State
     */
    public function seteEntity(Entity $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get idEntity
     *
     * @return \App\Entity\Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return State
     */
    public function setModule(Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }
}

