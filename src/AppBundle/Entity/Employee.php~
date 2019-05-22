<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="employee")
* @ORM\Entity
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
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $salary;

	/**
	 * @var text $description
	 *
	 * @ORM\Column(type="text", nullable=false)
	 */
	private $description;

    /**
     * @var company
     *
     * @ORM\ManyToOne(targetEntity="company")
     * @ORM\JoinColumn(name="company", referencedColumnName="id")
     */
    private $company_id;

    /**
     * @var designation
     *
     * @ORM\ManyToOne(targetEntity="designation")
     * @ORM\JoinColumn(name="desgination", referencedColumnName="id")
     */
    private $designation_id;
}
