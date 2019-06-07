<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ProductBundle\Form\Type\RegistrationType;
use ProductBundle\Form\Model\Registration;

class DefaultController extends Controller
{
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
    
    public function registerAction()
    {
        $form = $this->createForm(RegistrationType::class, new Registration());
        return $this->render('ProductBundle:Account:register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
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
}
