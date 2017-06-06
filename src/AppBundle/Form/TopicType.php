<?php

namespace AppBundle\Form;


use AppBundle\Entity\Topic;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopicType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentUser = $options['user'];

        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nazwa'
            ))
            ->add('dateAdded', DateType::class, array(
                'data' => new \DateTime()
            ))
            ->add('expiryDate', DateType::class, array(
                'widget' => 'choice',)
            )
            ->add('priority', ChoiceType::class, array(
                'label' => 'Priorytet',
                'choices' => array(
                    'Wysoki' => 'priorityHigh',
                    'Normalny' => 'priorityNormal',
                    'Niski' => 'priorityLow'
                )
            ))
            ->add('note', TextType::class, array(
                'label' => 'Notatka'
            ))
            ->add('user_added', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'data' => $currentUser,
                'disabled' => true
            ))
            ->add('user_responsible', EntityType::class, array(
                'label' => 'Użytkownik odpowiedzialny',
                'class' => 'AppBundle\Entity\User',
                'choice_label' => 'username',
                'data' => $currentUser,
            ))
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Topic::class,
            'user' => null
        ));

    }
}