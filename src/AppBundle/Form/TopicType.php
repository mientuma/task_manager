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
use Symfony\Component\Security\Core\User\User;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('dateAdded', DateType::class, array(
                'data' => new \DateTime()
            ))
            ->add('expiryDate', DateType::class, array(
                'widget' => 'choice',)
            )
            ->add('priority', ChoiceType::class, array(
                'choices' => array(
                    'Wysoki' => 'priorityHigh',
                    'Normalny' => 'priorityNormal',
                    'Niski' => 'priorityLow'
                )
            ))
            ->add('note', TextType::class)
            ->add('user_added', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'data' => User::class
            ))
            ->add('user_responsible', EntityType::class, array(
                'class' => 'AppBundle\Entity\User'
            ))
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Topic::class,
        ));

    }
}