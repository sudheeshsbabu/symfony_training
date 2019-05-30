<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmployeeBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
/**
 * Description of Employees
 *
 * @author reizend333
 */
class Employees {

    public $entityManager;

    /**
     * Constructor
     * @param EntityManagerInterface $em
     */
    function __construct(EntityManagerInterface $em) {
        $this->entityManager = $em;
    }
    
    /**
     * Get the list of employees.
     * @return array $employees
     */
    function getEmployees() {
        $employees = $this->entityManager->getRepository('EmployeeBundle:Employee')->findAll();
        return $employees;
    }
    
    /**
     * Get the largest salary.
     * @return array $LargestSalary
     */
    public function maxSalary() {
        // Fetch second largest salary.
        $LargestSalary = $this->entityManager->getRepository('EmployeeBundle:Employee')->getMaxEmployeeSalary();
        return $LargestSalary;
    }
    
}
