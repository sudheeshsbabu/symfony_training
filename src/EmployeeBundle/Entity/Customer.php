<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="customer")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Customer {

	/**
	 * @var integer $id
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
    private $id;
    
    /**
     * @var integer $code
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $code;

	/**
	 * @var string $name
	 *
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
    private $name;
    
    /**
	 * @var string $address
	 *
	 * @ORM\Column(type="text")
	 */
    private $address;
    
    /**
	 * @var string $city
	 *
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	private $city;

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
     * Set code
     *
     * @param integer $code
     *
     * @return Customer
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Customer
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
     * @return Customer
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
     * Set city
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCodeValue()
    {
        $this->code = mt_rand(10000,99999);
    }
 }
