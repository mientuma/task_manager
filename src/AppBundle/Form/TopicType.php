<?php

namespace AppBundle\Form;


use AppBundle\Entity\Topic;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
        $user = $options['user'];

        dump($user);

        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nazwa'
            ))
            ->add('dateAdded', DateType::class, array(
                'label' => 'Data dodania',
                'data' => new \DateTime()
            ))
            ->add('expiryDate', DateType::class, array(
                'label' => 'Termin',
                'data' => date_modify(new \DateTime(), '+1 week')
            ))
            ->add('priority', ChoiceType::class, array(
                'label' => 'Priorytet',

                'choices' => array(
                    'Wysoki' => 'priorityHigh',
                    'Normalny' => 'priorityNormal',
                    'Niski' => 'priorityLow'
                ),
                'data' => 'priorityNormal'
            ))
            ->add('note', TextareaType::class, array(
                'label' => 'Notatka',
                'required' => false
            ))
            ->add('user_added', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'data' => $user
            ))
            ->add('user_responsible', EntityType::class, array(
                'label' => 'Użytkownik odpowiedzialny',
                'class' => 'AppBundle\Entity\User',
                'data' => $user,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Topic::class,
            'user' => User::class
        ));

    }
}