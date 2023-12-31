<?php

    namespace App\Entity\FormFields\Users;

    use Symfony\Component\Validator\Constraints as Assert;


    class RegistrationFields
    {
        #[Assert\NotBlank(message: 'Entrer un pseudonyme pour continuer')]
        #[Assert\Length(
            min: 4,
            max: 15,
            minMessage: 'Ce pseudonyme est trop court, min: 4',
            maxMessage: 'Ce pseudonyme est trop long, max: 15'
        )]
        private string $pseudonyme;

        #[Assert\NotBlank(message: 'Un email est requis pour créer le compte')]
        #[Assert\Email(message: 'Entrer un email valide')]
        private string $email;

        #[Assert\NotBlank(message: 'Entrer votre niveau de jeu actuel')]
        #[Assert\Positive(message: 'Cet valeur doit être positif')]
        #[Assert\Range(
            notInRangeMessage: 'Le niveau de jeu actuel doit être compris entre 1 et 8',
            min: 1,
            max: 8
        )]
        private int $currentLevel;

        #[Assert\NotBlank(message: 'Un mot de passe est requis pour créer le compte')]
        private string $password;



        //setters
        public function setPseudonyme(string $pseudonyme): void
        {
            $this->pseudonyme = $pseudonyme;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setCurrentLevel(int $currentLevel): void
        {
            $this->currentLevel = $currentLevel;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }


        //getters
        public function getPseudonyme(): string
        {
            return $this->pseudonyme;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getCurrentLevel(): int
        {
            return $this->currentLevel;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }
    }