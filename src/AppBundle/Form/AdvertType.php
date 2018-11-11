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
        $builder->add('Category', EntityType::class, array(
                    'label'=>'Catégorie de votre annonce',
                    'class' => 'AppBundle:Categories',
                    'choice_label' => 'category',
                    ))
                ->add('Title', TextType::class,array('label'=>'Titre de votre annonce'))
                ->add('Content', TextareaType::class,array('label'=>'Votre annonce', 'attr' => array('rows' => 10)))
                ->add('Price', TextType::class,array('label'=>'Prix en €'))
                ->add('Author',    TextType::class,array('label'=>'Nom'))
                ->add('Email', EmailType::class,array('label'=>'Email'));
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
