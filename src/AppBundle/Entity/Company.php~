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
	*
	* @ORM\Column(type="integer")
	*/
	private $serial_no;
}
