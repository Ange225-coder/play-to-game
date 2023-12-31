<?php

    namespace App\FormTypes\Users;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use App\Entity\FormFields\Users\GameNicknameFormFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class GameNicknameFormTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('gameNickname', TextType::class, [
                    'label' => 'Entrer un pseudo joueur different de votre nom actuel',
                    'attr' => ['placeholder' => 'Ex: Boris404']
                ])
            ;
        }

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => GameNicknameFormFields::class
            ]);
        }
    }