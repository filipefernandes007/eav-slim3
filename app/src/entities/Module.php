<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Application as Application;

/**
 * Module
 *
 * @ORM\Table(name="module", 
              indexes={@ORM\Index(name="id_application", 
                                  columns={"id_application"})})
 * @ORM\Entity
 */
class Module
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
     * @var \Application
     *
     * @ORM\ManyToOne(targetEntity="Application")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_application", referencedColumnName="id")
     * })
     */
    private $application;


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
     * @return Module
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
     * Set Application
     *
     * @param \App\Entity\Application $application
     *
     * @return Module
     */
    public function setApplication(Application $application = null)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get Application
     *
     * @return \App\Entity\Application
     */
    public function getApplication()
    {
        return $this->application;
    }
}

