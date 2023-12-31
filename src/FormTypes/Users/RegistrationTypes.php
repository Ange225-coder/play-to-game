<?php

    namespace App\FormTypes\Users;

    use App\Entity\FormFields\Users\RegistrationFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('pseudonyme', TextType::class, [
                    'label' => 'Pseudonyme',
                    'attr' => ['placeholder' => 'Entrer votre pseudonyme']
                ])

                ->add('email', EmailType::class, [
                    'label' => 'Email',
                    'attr' => ['placeholder' => 'Entrer votre email']
                ])

                ->add('currentLevel', IntegerType::class, [
                    'label' => 'Niveau actuel',
                    'attr' => [
                        'placeholder' => 'Entrer votre niveau de jeu actuel',
                        'min' => 1,
                        'max' => 8,
                    ]
                ])

                ->add('password', PasswordType::class, [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'Mot de passe']
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationFields::class,
            ]);
        }
    }