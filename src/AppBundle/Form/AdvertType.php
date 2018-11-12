<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', EntityType::class, array(
                                        'class' => 'AppBundle:Categories',
                                        'label' => 'Choisissez votre catégorie *',
                                        'choice_label' => 'category',
                     ))
                ->add('Title', TextType::class,array('label'=>'Titre de votre annonce *'))
                ->add('Content', TextareaType::class,array('label'=>'Votre annonce *', 'attr' => array('rows' => 10)))
                ->add('Price', TextType::class,array('label'=>'Prix en € *'))
                ->add('Department', ChoiceType::class, array(
                                        'label'=>'Département *',
                                        'choices'  => array(
                                                '56 - Morbihan' => '56 - Morbihan'
                                        ),
                    ))
                ->add('City', TextType::class,array('label'=>'Ville *'))
                ->add('Author',    TextType::class,array('label'=>'Nom ou pseudo * '))
                ->add('Email', EmailType::class,array('label'=>'Email *'))
                ->add('Tel', TextType::class,array(
                    'required' => false,
                    'label'=>'Votre téléphone'))
                ->add('image',     ImageType::class, array(
                    'label' => 'Ajouter une image',
                    'required' => false
                ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_advert';
    }


}
