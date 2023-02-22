<?php

namespace App\Form;

use App\Entity\ParticipationSeance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Date;


class ParticipationSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeSport', ChoiceType::class, [
                'label' => 'Choisissez',
                'choices' => [
                    'Football'=>'Football',
                    'Basketball'=>'Basketball',
                ],
                'multiple' => false,
                'expanded' => false
            ])
            ->add('dateParticipation')

            /**->add('participant', ChoiceType::class, [
                'label' => 'Choisissez',
                'choices' => [
                ],
                'multiple' => true,
                'expanded' => false,
                'constraints' => [new Choice(['choices' => [new NotBlank()]])]
            ])**/
            ->add('seance')
            ->add('participant')
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ParticipationSeance::class,
        ]);
    }
}
