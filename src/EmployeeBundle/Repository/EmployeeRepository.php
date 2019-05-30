<?php
namespace EmployeeBundle\Repository;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmployeeRepository
 *
 * @author reizend333
 */
class EmployeeRepository extends \Doctrine\ORM\EntityRepository {
    /**
     * Fetches the second largest salary from employee table.
     * @return type array
     */
    public function getSecondMaxEmployeeSalary()
    {
        // Query to fetch max salary.
        $subQuery = $this->createQueryBuilder('e')
        ->select('max(e.salary)');
        
        // Query to fetch second max salary.
        $query = $this->createQueryBuilder('em')
        ->select('max(em.salary)')
        ->where($subQuery->expr()
        ->notIn('em.salary', $subQuery->getDQL()))
        ->getQuery()
        ->getResult();

        return $query;
    }
    
    /**
     * Fetches the maximum salary.
     * @return array $query
     */
    public function getMaxEmployeeSalary() {
        $query = $this->createQueryBuilder('e')
        ->select('max(e.salary)')
        ->getQuery()
        ->getResult();
        
        return $query;
    }
}
