<?php

    namespace App\FormTypes\Admins;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use App\Entity\FormFields\Admins\GamesSavingFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class GamesSavingTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('name', TextType::class, [
                    'label' => 'Nom du jeu',
                    'attr' => ['placeholder' => 'GTA V, Tekken, ...']
                ])

                ->add('type', TextType::class, [
                    'label' => 'Type de jeu',
                    'attr' => ['placeholder' => 'Tir, aventure, simulation, ...']
                ])

                ->add('requiredLevel', IntegerType::class, [
                    'label' => 'Niveau du jeu',
                    'attr' => [
                        'placeholder' => 'Entrer un niveau valide, [1, 8]',
                        'min' => 1,
                        'max' => 8,
                    ]
                ])

                ->add('numberOfPlayers', IntegerType::class, [
                    'label' => 'Nombre de joueurs',
                    'attr' => [
                        'placeholder' => 'Entrer un nombre de joueurs',
                        'min' => 1,
                        'max' => 4,
                    ]
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => GamesSavingFields::class,
            ]);
        }
    }