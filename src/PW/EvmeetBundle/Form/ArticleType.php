<?php

namespace PW\EvmeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu', ChoiceType::class, array('choices' => array('EV2' => 1, 'EV3' => 2, 'Labo' => 3)))
            ->add('dateInvitation', DateTimeType::class)
            ->add('niveauMin', ChoiceType::class, array('choices' => array('EV2' => 1, 'EV3' => 2, 'Labo' => 3)))
            ->add('niveauMax', ChoiceType::class, array('choices' => array('EV2' => 1, 'EV3' => 2, 'Labo' => 3)))
            ->add('commentaire', TextareaType::class)
            ->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PW\EvmeetBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_evmeetbundle_article';
    }


}
