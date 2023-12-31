<?php

    namespace App\Controller\Users;

    use App\Entity\Tables\Admins\Games;
    use App\Entity\Tables\Users\Players;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\Persistence\ManagerRegistry as Doctrine;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class StartingToPlayController extends AbstractController
    {
        #[Route(path: '/user/games/start/{id_game}', name: 'user_game_start')]
        #[IsGranted('ROLE_USER')]
        public function startingToPlay($id_game, Doctrine $doctrine): Response
        {
            $game = $doctrine->getRepository(Games::class)->find($id_game);

            $player = $doctrine->getRepository(Players::class)->findOneBy([
                'user' => $this->getUser()->getUserIdentifier(),
            ]);

            return $this->render('users/startingToPlay.html.twig', [
                'game' => $game,
                'player' => $player,
            ]);
        }
    }