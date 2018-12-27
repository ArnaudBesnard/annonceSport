<?php
/**
 * Created by PhpStorm.
 * User: Arno
 * Date: 04/12/2018
 * Time: 22:05
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SearchIndexType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('category', EntityType::class, array(
            'class' => 'AppBundle:Categories',
            'label' => false,
            'placeholder' =>'Catégorie',
            'choice_label' => 'category',
        ))
            ->add('title', TextType::class, array('label' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Votre recherche...',
                )))
            ->add('city', TextType::class, array('label' => false,
                'attr' => array(
                    'placeholder' => 'Localisation',
                )));
        //->add('save', SubmitType::class);
    }

    public function getParent()
    {
        return SearchType::class;
    }
}