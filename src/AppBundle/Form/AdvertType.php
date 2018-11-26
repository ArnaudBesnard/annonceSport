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

        $dpt = [];
        $communes = [];
        $json_dpt = file_get_contents('https://geo.api.gouv.fr/departements');
        $json_communes = file_get_contents('https://geo.api.gouv.fr/departements/56/communes');
        $json_data_dpt = json_decode($json_dpt);
        $json_data_communes = json_decode($json_communes);

        foreach($json_data_dpt as $v){
            $dpt[$v->code." - ".$v->nom] = $v->nom;
        };
        foreach($json_data_communes as $vc){
            $communes[$vc->nom] = $vc->nom;
        };
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
                                        'choices'  => $dpt
                    ))
                ->add('City', ChoiceType::class, array(
                                        'label'=>'Ville *',
                                        'choices'  => $communes
                    ))
                //Ajout des champs latitude et longitude pour géolocalisation
                //
                //->add('lat', HiddenType::class,array(
                //                     'label'=>'Latitude'
                //                     'data' => 'absdef'
                //  ))
                //->add('long', HiddenType::class,array(
                //                      'label'=>'Longitude'
                //                      'data' => 'absdef'
                //  ))
                ->add('Author',    TextType::class,array('label'=>'Nom ou pseudo * '))
                ->add('Email', EmailType::class,array('label'=>'Email *'))
                ->add('Tel', TextType::class,array(
                    'required' => false,
                    'label'=>'Votre téléphone'))
                ->add('image',   ImageType::class, array(
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
