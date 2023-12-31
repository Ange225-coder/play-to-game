<?php

    namespace App\Entity\FormFields\Admins;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationFields
    {
        #[Assert\NotBlank(message: 'Entrer un nom')]
        #[Assert\Length(
            min: 4,
            max: 12,
            minMessage: 'Ce nom est trop court, min: 4',
            maxMessage: 'Ce nom est trop long, max: 12'
        )]
        private string $username;

        #[Assert\NotBlank(message: 'Entrer un mot de passe')]
        private string $password;

        //setters
        public function setUsername(string $username): void
        {
            $this->username = $username;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }


        //getters
        public function getUsername(): string
        {
            return $this->username;
        }

        public function getPassword(): string
        {
            return $this->password;
        }
    }