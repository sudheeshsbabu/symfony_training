<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmployeeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EmployeeBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Session\Session;
use EmployeeBundle\Form\AccountType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormError;

/**
 * Description of AccountController
 *
 * @author reizend333
 */
class AccountController extends Controller {

    /**
     * Set admin role to user.
     * @return Response
     */
    public function indexAction()
    {
        // Retrieve entity manager of doctrine
        $em = $this->getDoctrine()->getManager();

        // Search for the UserEntity, retrieve the repository
        //$userRepository = $em->getRepository("myBundle\Entity\User");
        $userRepository = $em->getRepository("AppBundle:User");

        $user = $userRepository->findOneBy(["username" => "sudheesh"]);
        
        // Add the role that you want !
        $user->addRole("ROLE_ADMIN");

        // Save changes in the database
        $em->persist($user);
        $em->flush();
        
        return new Response(
            '<html><body><p>admin Role has been added to user</p></body></html>'
        );
    }
    
    /**
     * Edit Account.
     * @return type Response
     */
    public function addAccountAction() {

        $account = new Account();
        $form = $this->createAddAccountForm($account);
        return $this->render('EmployeeBundle:Account:account_form.html.twig', array(
        'form' => $form->createView(),
        ));
    }
    
    /**
     * Account add form
     * @param type $account
     * @return type
     */
    private function createAddAccountForm($account) {
        $form = $this->createForm(AccountType::class, $account, array(
            'action' => $this->generateUrl('account_save'),
        ));
        $form->add('save', SubmitType::class, array(
            'label' => 'Save Account',
            'attr' => array('class' => 'btn btn-sm btn-success'),
        ));
        return $form;
    }

    /**
     * Account form save action.
     * @param Request $request
     * @return type
     */
    public function saveAccountFormAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $status = 'error';
        $account = new Account();
        $form = $this->createAddAccountForm($account);
        $form->handleRequest($request);
        // Validate the form
        if ($form->isSubmitted()) {
            $customerCode = $form['customerCode']->getData();
            if (empty($customerCode)) {
                $error = new FormError('Please select a Customer Code');
                $form['customerCode']->addError($error);
            }
        }
        if ($form->isValid()) {
            $em->persist($account);
            $em->flush();
            $status = 'success';
            $account = new Account();
            $form = $this->createAddAccountForm($account);
        }
        $formView = $this->renderView('EmployeeBundle:Account:account_form.html.twig', array(
            'form' => $form->createView(),
        ));

        return new JsonResponse(['status' => $status, 'formView' => $formView]);
    }
    
    /**
     * Edit a record in account table.
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function editAccountAction(Request $request, $id) {

        $entityManager = $this->getDoctrine()->getManager();
        $account = $entityManager->getRepository('EmployeeBundle:Account')->find($id);
        
        // Set the comapany record to the form
        $form = $this->createEditAccountForm($account, $id);
        return $this->render('EmployeeBundle:Account:account_form.html.twig', array(
        'form' => $form->createView(),
        ));
    }
    
    /**
     * Create edit form for account with existing data of an entry.
     * @param Account $account
     * @param integer $id
     * @return Form
     */
    private function createEditAccountForm($account, $id) {
        $form = $this->createForm(AccountType::class, $account, array(
            'action' => $this->generateUrl('account_edit_save', array('id' => $id)),
        ));
        $form->add('save', SubmitType::class, array(
            'label' => 'Save Account',
            'attr' => array('class' => 'btn btn-sm btn-success'),
        ));
        return $form;
    }
    
    /**
     * Save the updated data of the department edit form.
     * @param Request $request
     * @param type $id
     * @return JsonResponse
     */
    public function editSaveAccountFormAction(Request $request, $id) {
        $entityManager = $this->getDoctrine()->getManager();
        $status = 'error';
        $account = $entityManager->getRepository('EmployeeBundle:Account')->find($id);
        $form = $this->createEditAccountForm($account, $id);
        $form->handleRequest($request);
        // Validate the form
        if ($form->isSubmitted()) {
            $customerCode = $form['customerCode']->getData();
            if (empty($customerCode)) {
                $error = new FormError('Please select a Customer Code');
                $form['customerCode']->addError($error);
            }
        }
        if ($form->isValid()) {
            $account = $entityManager->getRepository('EmployeeBundle:Account')->find($id);
            $entityManager->getRepository('EmployeeBundle:Account')->updateAccount($account);
            $status = 'success';
            $form = $this->createEditAccountForm($account, $id);
        }
        $formView = $this->renderView('EmployeeBundle:Account:account_form.html.twig', array(
            'form' => $form->createView(),
        ));

        return new JsonResponse(['status' => $status, 'formView' => $formView]);
    }
}
