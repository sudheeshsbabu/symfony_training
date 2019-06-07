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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Form;

/**
 * Description of RegistrationType
 *
 * @author reizend333
 */
class PeopleType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('country', DocumentType::class, [
                    'class' => 'ProductBundle:States',
                    'choice_label'=>'country',
                    // Not required here
//                    'query_builder' => function(DocumentRepository $er) {
//                        return $er->createQueryBuilder('d');
//                        ;
//                    },
                    'placeholder' => '-- Select --',
                    ])
                ->add('states')
                ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
                ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }
    
    private function onPreSubmit(FormEvent $event) 
    {
        $form = $event->getForm();
        $data = $event->getData();
        $country = array_key_exists('country', $data) ? $data['country'] : '';
        $this->addState($form, $country);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => People::class,
        ));
    }
    
    protected function addState(Form $form, $country) {
        $form->remove('states');
        $form->add('states', DocumentType::class, array(
                'class' => 'ProductBundle:States',
                'choice_label' => 'states',
                'placeholder' => '- State -',
                'query_builder' => function(DocumentRepository $er) use ($country) {
                    return $er->createQueryBuilder('s')
                    ->field('country')->equals($country);
                }
        ));
        
    }
    
    function onPreSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();
        $country = $data->getCountry() != NULL ? $data->getCountry() : '';
        $this->addState($form, $country);
    }
}
