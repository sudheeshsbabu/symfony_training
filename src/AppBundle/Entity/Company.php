<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="company")
* @ORM\Entity
*/
class Company {

	/**
	* @var integer $id
	* @ORM\Column(type="int")
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
	*
	* @ORM\Column(type="int")
	*/
	private $serial_no;

    /**
     * Get id
     *
     * @return \int
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
     * @param \int $serialNo
     *
     * @return Company
     */
    public function setSerialNo(\int $serialNo)
    {
        $this->serial_no = $serialNo;

        return $this;
    }

    /**
     * Get serialNo
     *
     * @return \int
     */
    public function getSerialNo()
    {
        return $this->serial_no;
    }
}
