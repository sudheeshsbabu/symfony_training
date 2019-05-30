<?php
namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="employee")
* @ORM\Entity
* @ORM\Entity(repositoryClass="EmployeeBundle\Repository\EmployeeRepository")
*/
class Employee {

	/**
	 * @var integer $id
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
    private $id;
    
    /**
     * @var integer $serial_no
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $serial_no;

	/**
	 * @var string $name
	 *
	 * @ORM\Column(type="string", length=200, nullable=false)
	 */
    private $name;
    
    /**
	 * @var string $village
	 *
	 * @ORM\Column(type="string", length=200, nullable=false)
	 */
    private $village;
    
    /**
	 * @var string $district
	 *
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	private $district;

    /**
     * @var string $salary
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $salary;

    /**
     * @var company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company", referencedColumnName="id", nullable=true)
     */
    private $companyId;

    /**
     * @var designation
     *
     * @ORM\ManyToOne(targetEntity="Designation")
     * @ORM\JoinColumn(name="designation", referencedColumnName="id", nullable=true)
     */
    private $designationId;

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
     * Set serialNo
     *
     * @param integer $serialNo
     *
     * @return Employee
     */
    public function setSerialNo($serialNo)
    {
        $this->serial_no = $serialNo;

        return $this;
    }

    /**
     * Get serialNo
     *
     * @return integer
     */
    public function getSerialNo()
    {
        return $this->serial_no;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Employee
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
     * Set village
     *
     * @param string $village
     *
     * @return Employee
     */
    public function setVillage($village)
    {
        $this->village = $village;

        return $this;
    }

    /**
     * Get village
     *
     * @return string
     */
    public function getVillage()
    {
        return $this->village;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Employee
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return Employee
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set companyId
     *
     * @param \EmployeeBundle\Entity\company $companyId
     *
     * @return Employee
     */
    public function setCompanyId(\EmployeeBundle\Entity\company $companyId = null)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return \EmployeeBundle\Entity\company
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set designationId
     *
     * @param \EmployeeBundle\Entity\designation $designationId
     *
     * @return Employee
     */
    public function setDesignationId(\EmployeeBundle\Entity\designation $designationId = null)
    {
        $this->designationId = $designationId;

        return $this;
    }

    /**
     * Get designationId
     *
     * @return \EmployeeBundle\Entity\designation
     */
    public function getDesignationId()
    {
        return $this->designationId;
    }
}
