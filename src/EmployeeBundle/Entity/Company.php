<?php
namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="company")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="EmployeeBundle\Repository\CompanyRepository")
 */
class Company {

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
	* @ORM\Column(type="string", length=200, nullable=false)
	*/
	private $name;

	/**
	* @var text $address
	*
	* @ORM\Column(type="text", nullable=false)
	*/
	private $address;

	/**
	 * @var integer serial_no
	 * @Assert\NotBlank(message="Please insert serial number")
     * @Assert\Type(
     * type="numeric",
     * message="The value {{ value }} is not a valid {{ type }}."
     * )
	 * @ORM\Column(type="integer")
     */
	private $serialNo;

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
     * @return Company
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
     * Set address
     *
     * @param string $address
     *
     * @return Company
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set serialNo
     *
     * @param integer $serialNo
     *
     * @return Company
     */
    public function setSerialNo($serialNo)
    {
        $this->serialNo = $serialNo;

        return $this;
    }

    /**
     * Get serialNo
     *
     * @return integer
     */
    public function getSerialNo()
    {
        return $this->serialNo;
    }
}
