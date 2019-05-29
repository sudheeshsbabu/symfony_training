<?php
namespace EmployeeBundle\Repository;

use EmployeeBundle\Entity\Department;
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
class DepartmentRepository extends \Doctrine\ORM\EntityRepository {
    /**
     * Update the company table.
     * @return type array
     */
    public function updateDepartment($data)
    {
        $queryBuilder = $this->createQueryBuilder('d');
        // Don't forget to give Bundle name before entity.
        $query = $queryBuilder->update('EmployeeBundle:Department', 'd')
                ->set('d.name', '?1')
                ->set('d.description', '?2')
                ->where('d.id = ?3')
                ->setParameter(1, $data->getName())
                ->setParameter(2, $data->getDescription())
                ->setParameter(3, $data->getId())
                ->getQuery();
        $query->execute();
    }
    

}
