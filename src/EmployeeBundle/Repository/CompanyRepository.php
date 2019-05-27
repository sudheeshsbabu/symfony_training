<?php
namespace EmployeeBundle\Repository;

use EmployeeBundle\Entity\Company;
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
class CompanyRepository extends \Doctrine\ORM\EntityRepository {
    /**
     * Update the company table.
     * @return type array
     */
    public function updateCompany($data)
    {
        $queryBuilder = $this->createQueryBuilder('c');
        // Don't forget to give Bundle name before entity.
        $query = $queryBuilder->update('EmployeeBundle:Company', 'c')
                ->set('c.name', '?1')
                ->set('c.address', '?2')
                ->set('c.serialNo', '?3')
                ->where('c.id = ?4')
                ->setParameter(1, $data->getName())
                ->setParameter(2, $data->getAddress())
                ->setParameter(3, $data->getSerialNo())
                ->setParameter(4, $data->getId())
                ->getQuery();
        $process = $query->execute();
        return $process;
    }
    

}
