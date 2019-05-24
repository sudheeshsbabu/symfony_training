<?php

namespace EmployeeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use EmployeeBundle\Entity\Department;
use EmployeeBundle\Entity\Designation;
use EmployeeBundle\Entity\Employee;
use Symfony\Component\HttpFoundation\Session\Session;
use EmployeeBundle\Repository\EmployeeRepository;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmployeeBundle:Default:index.html.twig');
    }
    
    /**
     * A simple function to perform database transactions.
     */
    public function createAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        // Fetch a record from foreign table company
        $company = $entityManager->getRepository('EmployeeBundle:Company')->findOneBy(
                        array('name' => 'Google')
                    );

        // Fetch a record from foreign table designation
        $designation = $entityManager->getRepository('EmployeeBundle:Designation')->findOneBy(
                        array('name' => 'Software Developer')
                    );

        // Add a record to employee table via setter methods.
        $employee = new Employee();
        $employee->setSerialNo(5002);
        $employee->setName('Raj');
        $employee->setVillage('v4');
        $employee->setDistrict('d1');
        $employee->setSalary(95000);
        $employee->setCompanyId($company);
        $employee->setDesignationId($designation);

        $entityManager->persist($employee);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$employee->getId());
    }
    
    /**
     * Function to list all employees.
     */
    public function getEmployeesAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $entityManager->getRepository('EmployeeBundle:Employee')->findAll();

        return $this->render(
                'EmployeeBundle:Default:employee-list.html.twig', 
                ['employees' => $employees]
        );
    }    
    
    /**
     * Function to show detail of employee.
     * Arguments: $id
     */
    public function getEmployeeDetailAction($id) {
        
        // Validate the $id argument.
        if ($id > 0) {
            $entityManager = $this->getDoctrine()->getManager();
            $employee = $entityManager->getRepository('EmployeeBundle:Employee')->find($id);

            // Invoke session object
            $session = new Session();

            $session->set('employee_company_name', $employee->getCompanyId()->getName());

            return $this->render(
                'EmployeeBundle:Default:employee.html.twig', 
                ['employee' => $employee, 'company' => $session->get('employee_company_name')]
            );
        }
    }

    /**
     * Displays second largest salary form employee table.
     */
    public function getSecondMaxSalaryAction() {
        $entityManager = $this->getDoctrine()->getManager();

        // Fetch second largest salary.
        $secondLargestSalary = $entityManager->getRepository('EmployeeBundle:Employee')->getSecondMaxEmployeeSalary();

        // Fetch all records with the salary value = $secondLargestSalary
        if (!empty($secondLargestSalary)) {
            $records = $entityManager->getRepository('EmployeeBundle:Employee')->findBy(
                        array('salary' => $secondLargestSalary[0][1])
                    );
        return $this->render(
                'EmployeeBundle:Default:second_largest_salary.html.twig',
                ['employees' => $records]
        );
        }
    }
}
