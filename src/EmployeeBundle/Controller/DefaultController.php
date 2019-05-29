<?php

namespace EmployeeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EmployeeBundle\Entity\Department;
use EmployeeBundle\Entity\Designation;
use EmployeeBundle\Entity\Employee;
use EmployeeBundle\Entity\Company;
use Symfony\Component\HttpFoundation\Session\Session;
use EmployeeBundle\Repository\EmployeeRepository;
use EmployeeBundle\Form\CompanyType;
use EmployeeBundle\Form\DepartmentType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    /**
     * Insert a new Company.
     * @param Request $request
     * @return type Request
     */
    public function addCompanyAction(Request $request)
    {     
        $company = new Company();

        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);
        
        // Validate Serial number & set error message if necessary.
        $serialNo = $form['serialNo']->getData();
        if ($form->isSubmitted() && !is_numeric($serialNo)) {
            $error = new FormError('Serial no should be numeric');
            $form['serialNo']->addError($error);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $company = $form->getData();
//            dump($company);
//            die;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('employe_list_companies');
        }

        return $this->render('EmployeeBundle:Default:company_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * List all companies.
     * @return type Response
     */
    public function listCompaniesAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $companies = $entityManager->getRepository('EmployeeBundle:Company')->findAll();

        return $this->render('EmployeeBundle:Default:company_list.html.twig',
                ['companies' => $companies]);
    }
    
    /**
     * Delete a company.
     * @param type integer
     * @return type Response
     */
    public function deleteCompanyAction($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $company = $entityManager->getRepository('EmployeeBundle:Company')->find($id);
        $entityManager->remove($company);
        $entityManager->flush();
        
        return $this->redirectToRoute('employe_list_companies');
    }
    
    /**
     * Edit a record in Company table.
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function editCompanyAction(Request $request, $id) {
        
        $entityManager = $this->getDoctrine()->getManager();
        $company = $entityManager->getRepository('EmployeeBundle:Company')->find($id);
        
        // Set the comapany record to the form
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        
        // Validate Serial number & set error message if necessary.
        $serialNo = $form['serialNo']->getData();
        if ($form->isSubmitted() && !is_numeric($serialNo)) {
            $error = new FormError('Serial no should be numeric');
            $form['serialNo']->addError($error);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $company = $form->getData();
            
            $status = $entityManager->getRepository('EmployeeBundle:Company')->updateCompany($company);
            return $this->redirectToRoute('employe_list_companies');
        }

        return $this->render('EmployeeBundle:Default:company_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * Show Department form.
     * @return type Response
     */
    public function showDepartmentFormAction() {
        $department = new Department();
        $form = $this->createAddForm($department);
        return $this->render('EmployeeBundle:Default:department_form.html.twig', array(
        'form' => $form->createView(),
        ));
    }
    
    private function createAddForm($department) {
        $form = $this->createForm(DepartmentType::class, $department, array(
            'action' => $this->generateUrl('department_save'),
        ));
        $form->add('save', SubmitType::class, array(
            'label' => 'Save Company',
            'attr' => array('class' => 'btn btn-sm btn-success'),
        ));
        return $form;
    }
    
    /**
     * Department form save action.
     * @param Request $request
     * @return type
     */
    public function saveDepartmentFormAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $status = 'error';
        $dataView = '';
        $department = new Department();
        $form = $this->createAddForm($department);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($department);
            $em->flush();
            $status = 'success';
            $department = new Department();
            $form = $this->createAddForm($department);
        }
        $formView = $this->renderView('EmployeeBundle:Default:department_form.html.twig', array(
            'form' => $form->createView(),
        ));

        return new JsonResponse(['status' => $status, 'formView' => $formView]);;
    }
    
    /**
     * List departments.
     * @return type
     */
    public function listDepartmentsAction() {
       $entityManager = $this->getDoctrine()->getManager();
       $departments = $entityManager->getRepository('EmployeeBundle:Department')->findAll();
       if (!empty($departments)) {
           return $this->render('EmployeeBundle:Default:department_list.html.twig', array(
               'departments' => $departments
           ));
       }
    }
    
    /**
     * Delete a company.
     * @param type integer
     * @return type Response
     */
    public function deleteDepartmentAction($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $department = $entityManager->getRepository('EmployeeBundle:Department')->find($id);
        $entityManager->remove($department);
        $entityManager->flush();
        
        return $this->redirectToRoute('departments_list');
    }
}
