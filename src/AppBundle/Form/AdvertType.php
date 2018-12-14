<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Departments;
use AppBundle\Entity\User;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
        $builder

            ->add('category', EntityType::class, array(
            'class' => 'AppBundle:Categories',
            'placeholder' => 'Catégorie',
            'label' => 'Choisissez votre catégorie *',
            'choice_label' => 'category',
            ))
            ->add('Title', TextType::class,array('label'=>'Titre de votre annonce *'))
            ->add('Content', TextareaType::class,array('label'=>'Votre annonce *', 'attr' => array('rows' => 10)))
            ->add('Price', TextType::class,array('label'=>'Prix en € *'))
            ->add('department', EntityType::class, array(
                'class' => 'AppBundle:Departments',
                'label' => 'Choisissez votre département *',
                'placeholder' => '...'
            ))
            ->add('city',    TextType::class,array('label'=>'Votre ville * '))
            ->add('Tel', TextType::class,array(
                'required' => false,
                'label'=>'Votre téléphone (facultatif)'))
            ->add('image',   ImageType::class, array(
                'label' => 'Ajouter une image (max 800*600)',
                'required' => false
            ))

            ->add('published', CheckboxType::class, array(
                'label'    => 'Valider cette annonce',
                'required' => false,
            ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Advert',
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