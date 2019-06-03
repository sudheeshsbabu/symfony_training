<?php
namespace EmployeeBundle\Repository;

use EmployeeBundle\Entity\Account;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountRepository
 *
 * @author reizend333
 */
class AccountRepository extends \Doctrine\ORM\EntityRepository {
    /**
     * Update the account table.
     * @return type array
     */
    public function updateAccount($data)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        // Don't forget to give Bundle name before entity.
        $query = $queryBuilder->update('EmployeeBundle:Account', 'a')
                ->set('a.accountNumber', '?1')
                ->set('a.customerCode', '?2')
                ->set('a.balance', '?3')
                ->set('a.accountType', '?4')
                ->where('a.id = ?5')
                ->setParameter(5, $data->getId())
                ->setParameter(1, $data->getAccountNumber())
                ->setParameter(2, $data->getCustomerCode())
                ->setParameter(3, $data->getBalance())
                ->setParameter(4, $data->getAccountType())
                ->getQuery();
        $query->execute();
    }
    
    /**
     * Find the records matching the search input value.
     * @param string $inputValue
     * @return array
     */
    public function searchAccount($inputValue) {
        $inputValue .= "%";
        $query = $this->createQueryBuilder('a')
        ->select('a')
        ->where('a.accountNumber LIKE ?1')
        ->setParameter(1, $inputValue)
        ->getQuery()
        ->getResult();
        return $query;
    }
}
