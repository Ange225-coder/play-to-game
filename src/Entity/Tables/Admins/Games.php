<?php

    namespace App\Entity\Tables\Admins;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'games')]
    class Games
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55)]
        private string $name;

        #[ORM\Column(type: 'string', length: 55)]
        private string $type;

        #[ORM\Column(type: 'integer')]
        private int $requiredLevel;

        #[ORM\Column(type: 'integer')]
        private int $numberOfPlayers;

        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

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
        public function getId(): int
        {
            return $this->id;
        }

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