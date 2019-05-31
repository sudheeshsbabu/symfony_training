<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="account_type")
* @ORM\Entity
*/
class AccountType {
	
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
	* @ORM\Column(type="string", length=20, nullable=false)
	*/
	private $name;

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
     * @return AccountType
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
     * Generates the magic method
     * 
     */
    public function __toString(){
        $value = (string)$this->name;
        return $value;
    }
}
