<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="account")
* @ORM\Entity
*/
class Account {
	
    /**
	 * @var integer $id
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
    private $id;
    
    /**
     * @var integer $accountNumber
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $accountNumber;
    
    /**
     * @var integer $customerCode
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customer_code", referencedColumnName="code", nullable=false)
     */
    private $customerCode;

    /**
     * @var integer $balance
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $balance;
    
    /**
     * @var integer $accountType
     *
     * @ORM\ManyToOne(targetEntity="AccountType")
     * @ORM\JoinColumn(name="account_type", referencedColumnName="name", nullable=false)
     */
    private $accountType;

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
     * Set accountNumber
     *
     * @param integer $accountNumber
     *
     * @return Account
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return integer
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set customerCode
     *
     * @param \EmployeeBundle\Entity\Customer $customerCode
     *
     * @return Account
     */
    public function setCustomerCode(\EmployeeBundle\Entity\Customer $customerCode)
    {
        $this->customerCode = $customerCode;

        return $this;
    }

    /**
     * Get customerCode
     *
     * @return \EmployeeBundle\Entity\Customer
     */
    public function getCustomerCode()
    {
        return $this->customerCode;
    }

    /**
     * Set accountType
     *
     * @param \EmployeeBundle\Entity\AccountType $accountType
     *
     * @return Account
     */
    public function setAccountType(\EmployeeBundle\Entity\AccountType $accountType)
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return \EmployeeBundle\Entity\AccountType
     */
    public function getAccountType()
    {
        return $this->accountType;
    }
}
