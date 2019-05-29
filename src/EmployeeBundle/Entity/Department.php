<?php
namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="department")
* @ORM\Entity
* @ORM\Entity(repositoryClass="EmployeeBundle\Repository\DepartmentRepository")
*/
class Department {

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
     * @return Department
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
     * @return Department
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
}
