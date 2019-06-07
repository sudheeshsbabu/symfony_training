<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ProductBundle\Form\Type\RegistrationType;
use ProductBundle\Form\Model\Registration;
use ProductBundle\Document\People;
use ProductBundle\Form\Type\PeopleType;
use ProductBundle\Document\States;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * Sample function to perform mongodb curd operations.
     * @return Response
     */
    public function indexAction()
    {
//        return $this->render('ProductBundle:Default:index.html.twig');
//        $product = new Product();
//        $product->setName('A Foo Bar');
//        $product->setPrice('19.99');
//
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $dm->persist($product);
//        $dm->flush();
//
//        return new Response('Created product id '.$product->getId());
            $id = '5cf8bc2daa485b43d3703671';
            $price = 19.99;
            $repository = $this->get('doctrine_mongodb')
                ->getRepository('ProductBundle:Product');
            $product = $repository->findOneByPrice($price);

            if (!$product) {
                throw $this->createNotFoundException('No product found for id '.$id);
            }
            return new Response('Created product id '.$product->getPrice());
        
    }
    
    /**
     * User Registration form.
     * @return type
     */
    public function registerAction()
    {
        $form = $this->createForm(RegistrationType::class, new Registration());
        return $this->render('ProductBundle:Account:register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * User Registration form action part.
     * @param Request $request
     * @return type
     */
    public function registerSaveAction(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $form = $this->createForm(RegistrationType::class, new Registration());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();

            $dm->persist($registration->getUser());
            $dm->flush();

            return $this->redirectToRoute('user_registration');
        }

        return $this->render('ProductBundle:Account:register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * Add people form.
     * @return type
     */
    public function addPeopleAction() {
        $people = new People();
        $form = $this->createAddPeopleForm($people);
        return $this->render('ProductBundle:Account:people_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Add people form creator.
     * @param type $people
     * @return type
     */
    private function createAddPeopleForm($people) {
        $form = $this->createForm(PeopleType::class, $people, array(
            'action' => $this->generateUrl('product_people_save'),
        ));
        $form->add('save', SubmitType::class, array(
            'label' => 'Save',
            'attr' => array('class' => 'btn btn-sm btn-success'),
        ));
        return $form;
    }
    
    /**
     * Action for add people form.
     * @param Request $request
     * @return \ProductBundle\Controller\JsonResponse
     */
    public function savePeopleFormAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $status = 'error';
        $people = new People();
        $form = $this->createAddPeopleForm($people);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($people);
            $em->flush();
            $status = 'success';
            $people = new People();
            $form = $this->createAddPeopleForm($people);
        }
        $formView = $this->renderView('ProductBundle:Account:people_form.html.twig', array(
            'form' => $form->createView(),
        ));

        return new JsonResponse(['status' => $status, 'formView' => $formView]);
    }
}
