<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="designation")
* @ORM\Entity
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
  * @ORM\ManyToOne(targetEntity="department")
  * @ORM\JoinColumn(name="department", referencedColumnName="id")
  */
  private $department_id;
  
  
}
