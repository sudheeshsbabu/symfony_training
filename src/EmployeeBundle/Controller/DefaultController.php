<?php

namespace EmployeeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use EmployeeBundle\Entity\Department;
use EmployeeBundle\Entity\Designation;
use EmployeeBundle\Entity\Employee;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmployeeBundle:Default:index.html.twig');
    }
    public function createAction()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        
        $company = $entityManager->getRepository('EmployeeBundle:Company')->findOneBy(
                        array('name' => 'Google')
                    );

        $designation = $entityManager->getRepository('EmployeeBundle:Designation')->findOneBy(
                        array('name' => 'Software Developer')
                    );

        $employee = new Employee();
        $employee->setSerialNo(5002);
        $employee->setName('Raj');
        $employee->setVillage('v4');
        $employee->setDistrict('d1');
        $employee->setSalary(95000);
        $employee->setCompanyId($company);
        $employee->setDesignationId($designation);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($employee);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$employee->getId());
    }
    
    public function getEmployeesAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $entityManager->getRepository('EmployeeBundle:Employee')->findAll();

        return $this->render(
                'EmployeeBundle:Default:employee-list.html.twig', 
                ['employees' => $employees]
        );
    }
    public function getEmployeeDetailAction($id) {
        if ($id > 0) {
            $entityManager = $this->getDoctrine()->getManager();
            $employee = $entityManager->getRepository('EmployeeBundle:Employee')->find($id);
            return $this->render(
                'EmployeeBundle:Default:employee.html.twig', 
                ['employee' => $employee]
            );
        }
    }
}
