<?php

    namespace App\Entity\Tables\Users;

    use Doctrine\ORM\Mapping as ORM;
    use DateTime;

    #[ORM\Entity]
    #[ORM\Table(name: 'players')]
    class Players
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55, unique: true)]
        private string $user;

        #[ORM\Column(type: 'string', length: 55, unique: true)]
        private string $gameNickname;

        #[ORM\Column(type: 'integer')]
        private int $userLevel;

        #[ORM\Column(type: 'string', length: 55)]
        private string $gameName;

        #[ORM\Column(type: 'integer')]
        private int $gameLevel;

        #[ORM\Column(type: 'datetime')]
        private Datetime $registrationDate;

        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setUser(string $user): void
        {
            $this->user = $user;
        }

        public function setGameNickname(string $gameNickname): void
        {
            $this->gameNickname = $gameNickname;
        }

        public function setUserLevel(int $userLevel): void
        {
            $this->userLevel = $userLevel;
        }

        public function setGameName(string $gameName): void
        {
            $this->gameName = $gameName;
        }

        public function setGameLevel(int $gameLevel): void
        {
            $this->gameLevel = $gameLevel;
        }

        public function setRegistrationDate(DateTime $registrationDate): void
        {
            $this->registrationDate = $registrationDate;
        }


        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getUser(): string
        {
            return $this->user;
        }

        public function getGameNickname(): string
        {
            return $this->gameNickname;
        }

        public function getUserLevel(): int
        {
            return $this->userLevel;
        }

        public function getGameName(): string
        {
            return $this->gameName;
        }

        public function getGameLevel(): int
        {
            return $this->gameLevel;
        }

        public function getRegistrationDate(): DateTime
        {
            return $this->registrationDate;
        }
    }