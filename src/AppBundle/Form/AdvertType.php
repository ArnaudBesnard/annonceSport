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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $communes = [];
        $json_communes = file_get_contents('https://geo.api.gouv.fr/departements/56/communes');
        $json_data_communes = json_decode($json_communes);
        foreach($json_data_communes as $vc){
            $communes[$vc->nom] = $vc->nom;
        };
        $builder->add('category', EntityType::class, array(
            'class' => 'AppBundle:Categories',
            'label' => 'Choisissez votre catégorie *',
            'choice_label' => 'category'
        ))
            ->add('Title', TextType::class,array('label'=>'Titre de votre annonce *'))
            ->add('Content', TextareaType::class,array('label'=>'Votre annonce *', 'attr' => array('rows' => 10)))
            ->add('Price', TextType::class,array('label'=>'Prix en € *'))
            ->add('department', EntityType::class, array(
                'class' => 'AppBundle:Departments',
                'label' => 'Choisissez votre département *',
                'placeholder' => '...'
            ))
            ->add('city', TextType::class,array('label'=>'Votre ville *'))

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