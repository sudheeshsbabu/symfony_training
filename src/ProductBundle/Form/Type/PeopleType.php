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
class PeopleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name')
                ->add('country', DocumentType::class, [
                    'class' => 'ProductBundle:Country',
                    'choice_label' => 'name',
                    'query_builder' => function(DocumentRepository $er) {
                        return $er->createQueryBuilder('c');
                    },
                    'placeholder' => '-- Country --',
                ])
                ->add('state')
                ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
                ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => People::class,
        ));
    }

    protected function addState(Form $form, $country) {

        $form->remove('state');
        $form->add('state', DocumentType::class, array(
            'class' => 'ProductBundle:States',
            'choice_label' => 'state',
            'placeholder' => '-- State --',
            'required' => false,
            'query_builder' => function(DocumentRepository $er) use ($country) {
                return $er->createQueryBuilder('s');//->field('country')->equals($country);
            }
        ));
    }

    function onPreSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();
        $country = array_key_exists('country', $data) ? $data['country'] : '';
        $country = $data->getCountry() != NULL ? $data->getCountry() : '';

        $this->addState($form, $country);
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();
        $country = array_key_exists('country', $data) ? $data['country'] : '';

        $this->addState($form, $country);
    }

}
