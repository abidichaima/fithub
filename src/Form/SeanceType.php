<?php

namespace App\Form;

use App\Entity\Seance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $startDate = new \DateTime();

        // Calculate end date as start date plus 2 hours
        $endDate = (clone $startDate)->add(new \DateInterval('PT1H'));



        $builder
            ->add('titreSeance')
            ->add('descriptionSeance')
            ->add('nbParticipantSeance')
            ->add('dateDebutSeance', DateTimeType::class, [
                'widget' => 'choice',
                'html5' => false,
                'label' => 'Date début de la séance',
                'data' => $startDate, // Set start date as default value
                'attr' => [
                    'class' => 'form-control datetimepicker-input',
                    'data-toggle' => 'datetimepicker',
                    'data-target' => '#datetimepicker1'
                ]
            ])
            ->add('dateFinSeance', DateTimeType::class, [
                'widget' => 'choice',
                'html5' => false,
                'label' => 'Date fin de la séance',
                'data' => $endDate, // Set end date as default value
                'attr' => [
                    'class' => 'form-control datetimepicker-input',
                    'data-toggle' => 'datetimepicker',
                    'data-target' => '#datetimepicker2'
                ]
            ])
            ->add('coach')
            /**->add('id_Coach', ChoiceType::class, [
                'label' => 'Choisissez',
                'choices' => [
                ],
                'multiple' => true,
                'expanded' => false,
                'constraints' => [new Choice(['choices' => [new NotBlank()]])]
            ]);**/;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
            'invalid_message' => 'La date de début doit être antérieure à la date de fin',
            'constraints' => [
                new Callback([$this, 'validate']),
            ],
        ]);
    }

    public function validate($data, ExecutionContextInterface $context)
    {
        $dateDebut = $data->getDateDebutSeance();
        $dateFin = $data->getDateFinSeance();

        if ($dateDebut >= $dateFin) {
            $context->buildViolation('La date de début doit être antérieure à la date de fin')
                ->atPath('dateDebutSeance')
                ->addViolation();
        }
    }


}
