<?php

namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="designation")
 * @ORM\Entity/**
 */
class Designation {

    /**
     * @var integer $id
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var text $description
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @var department
     *
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumn(name="department", referencedColumnName="id", nullable=true)
     */
    private $department;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Designation
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Designation
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set department
     *
     * @param \EmployeeBundle\Entity\department $department
     *
     * @return Designation
     */
    public function setDepartment(\EmployeeBundle\Entity\department $department = null) {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \EmployeeBundle\Entity\department
     */
    public function getDepartment() {
        return $this->department;
    }

}
