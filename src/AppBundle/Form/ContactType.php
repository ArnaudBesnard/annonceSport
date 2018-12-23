<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,array('label'=>'Votre nom'))
            ->add('subject', TextType::class,array('label'=>'Le sujet de votre message'))
            ->add('email', EmailType::class, array(
                'label' => 'Votre email',
                'constraints' => array(
                    new NotBlank(array("message" => "Renseignez votre email")),
                    new Email(array("message" => "Votre email ne semble pas valide")),
                )
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'Votre message',
                'attr' => array('rows' => 10),
                'constraints' => array(
                    new NotBlank(array("message" => "Inscrivez votre message ici")),
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }
}