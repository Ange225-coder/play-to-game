<?php

    namespace App\Entity\FormFields\Users;

    use Symfony\Component\Validator\Constraints as Assert;

    class GameNicknameFormFields
    {
        #[Assert\NotBlank(message: 'Un nom de joueur est requis pour jouer au jeu')]
        #[Assert\Length(
            min: 5,
            max: 15,
            minMessage: 'Ce nom est court, min: 5',
            maxMessage: 'Ce nom est long, max: 15'
        )]
        private string $gameNickname;


        public function setGameNickname(string $gameNickname): void
        {
            $this->gameNickname = $gameNickname;
        }

        public function getGameNickname(): string
        {
            return $this->gameNickname;
        }
    }