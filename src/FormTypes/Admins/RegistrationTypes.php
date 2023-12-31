<?php

    namespace App\FormTypes\Admins;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use App\Entity\FormFields\Admins\RegistrationFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('username', TextType::class, [
                    'attr' => ['placeholder' => 'Entrer un nom']
                ])

                ->add('password', PasswordType::class, [
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