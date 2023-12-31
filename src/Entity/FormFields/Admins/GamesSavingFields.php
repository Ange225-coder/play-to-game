<?php

    namespace App\Entity\FormFields\Admins;

    use Symfony\Component\Validator\Constraints as Assert;

    class GamesSavingFields
    {
        #[Assert\NotBlank(message: 'Un nom de jeux est requis')]
        #[Assert\Length(
            min: 4,
            max: 20,
            minMessage: 'Ce nom de jeux est trop court, min: 4',
            maxMessage: 'Ce nom de jeux est trop long, max: 20'
        )]
        private string $name;

        #[Assert\NotBlank(message: 'Un type de jeux est requis')]
        #[Assert\Length(
            min: 3,
            max: 30,
            minMessage: 'Type trop court, min: 3',
            maxMessage: 'Type trop long, max: 20'
        )]
        private string $type;

        #[Assert\NotBlank(message: 'Entrer un niveau pour chaque jeux ajouter ce jeux')]
        #[Assert\Positive(message: 'Entrer un nombre positif pour le niveau du jeux')]
        #[Assert\Range(
            notInRangeMessage: 'Le niveau doit être compris entre 1 et 8',
            min: 1,
            max: 8
        )]
        private int $requiredLevel;

        #[Assert\NotBlank(message: 'Un nombre de player est requis pour ce jeu')]
        #[Assert\Positive(message: 'Entrer un nombre positif')]
        #[Assert\Range(
            notInRangeMessage: 'Le nombre de players doit être compris entre 1 et 4',
            min: 1,
            max: 4
        )]
        private int $numberOfPlayers;


        //setters
        public function setName(string $name): void
        {
            $this->name = $name;
        }

        public function setType(string $type): void
        {
            $this->type = $type;
        }

        public function setRequiredLevel(int $requiredLevel): void
        {
            $this->requiredLevel = $requiredLevel;
        }

        public function setNumberOfPlayers(int $numberOfPlayers): void
        {
            $this->numberOfPlayers = $numberOfPlayers;
        }


        //getters
        public function getName(): string
        {
            return $this->name;
        }

        public function getType(): string
        {
            return $this->type;
        }

        public function getRequiredLevel(): int
        {
            return $this->requiredLevel;
        }

        public function getNumberOfPlayers(): int
        {
            return $this->numberOfPlayers;
        }
    }