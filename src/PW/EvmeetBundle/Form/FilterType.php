<?php

namespace PW\EvmeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu', ChoiceType::class, array('choices' => array('EV2' => 'EV2', 'EV3' => 'EV3', 'Labo' => 'Labo'), 'placeholder' => 'Choisir un lieu','required' => false))
            ->add('dateInvitation', DateType::class, array('widget' => 'single_text','html5' => false, 'format' => 'dd/MM/yyyy','required' => false))
            ->add('niveau', ChoiceType::class, array('choices' => array('4A' => 1, '4B' => 2, '4C' => 3,'5A' => 4, '5B' => 5, '5C' => 6,'6A' => 7, '6B' => 8, '6C' => 9,'7A' => 10, '7B' => 11, '7C' => 12, '8A' => 13),'required' => false, 'placeholder' => 'Choisir un niveau'))
            ->add('save', SubmitType::class, array('label' => 'Filtrer'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PW\EvmeetBundle\Entity\Filter'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_evmeetbundle_filter';
    }


}
