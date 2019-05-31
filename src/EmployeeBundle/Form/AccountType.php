<?php

namespace EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AccountType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('accountNumber')
                ->add('balance')
                ->add('customerCode', EntityType::class, [
                    'class' => 'EmployeeBundle:Customer',
                    'choice_label' => 'code',
                    'placeholder' => '-- Select --',
                    ])
                ->add('accountType',  EntityType::class, [
                    'class' => 'EmployeeBundle:AccountType',
                    'choice_label' => 'name',
                    'placeholder' => '-- Select --',
                    ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmployeeBundle\Entity\Account'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'employeebundle_account';
    }


}
