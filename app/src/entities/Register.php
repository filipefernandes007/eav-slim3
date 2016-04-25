<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Entity as Entity;
use App\Entity\Register as Register;
use App\Entity\State as State;

/**
 * Register
 *
 * @ORM\Table(name="register", uniqueConstraints={@ORM\UniqueConstraint(    name="idx_unique_register_entity", columns={"id", "id_entity"}), @ORM\UniqueConstraint(name="idx_unique_register_state", columns={"id", "id_state"})}, indexes={@ORM\Index(name="IDX_8CAA6391BB9D5A2", columns={"id_parent"}), @ORM\Index(name="IDX_8CAA639281FF185", columns={"id_entity"}), @ORM\Index(name="IDX_8CAA6394D1693CB", columns={"id_state"}), @ORM\Index(name="idx_register_state", columns={"id", "id_state"})})
 * @ORM\Entity(repositoryClass="App\Repository\RegisterRepository")
 */
class Register
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\Register
     *
     * @ORM\ManyToOne(targetEntity="Register")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Register", mappedBy="parent")
     */
    private $children;

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
     * @var \App\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_state", referencedColumnName="id")
     * })
     */
    private $state;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * Set Parent
     *
     * @param \App\Entity\Register $parent
     *
     * @return Register
     */
    public function setParent(Register $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get Parent
     *
     * @return \App\Entity\Register
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get Children
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * Set Entity
     *
     * @param \App\Entity\Entity $entity
     *
     * @return Register
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
     * Set State
     *
     * @param \App\Entity\State $state
     *
     * @return Register
     */
    public function setState(State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get State
     *
     * @return \App\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }
}

