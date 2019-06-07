<?php

namespace ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use ProductBundle\Document\States;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Query\Builder;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ProductBundle\Document\People;

/**
 * Description of RegistrationType
 *
 * @author reizend333
 */
class PeopleType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('country', DocumentType::class, [
            'class' => 'ProductBundle:States',
            'choice_label'=>'country',
            // Not required here
//            'query_builder' => function(DocumentRepository $er) {
//                return $er->createQueryBuilder('d');
//                ;
//            },
            'placeholder' => '-- Select --',
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => People::class,
        ));
    }
}
