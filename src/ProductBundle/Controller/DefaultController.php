<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;

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
            $product = $this->get('doctrine_mongodb')
                ->getRepository('ProductBundle:Product')
                ->find($id);

            if (!$product) {
                throw $this->createNotFoundException('No product found for id '.$id);
            }
            return new Response('Created product id '.$product->getId());
        
    }
}
