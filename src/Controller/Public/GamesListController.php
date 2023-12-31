<?php

    namespace App\Controller\Public;

    use App\Entity\Tables\Admins\Games;
    use Doctrine\Persistence\ManagerRegistry as PersistenceRegistry;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class GamesListController extends AbstractController
    {
        #[Route(path: '/public/games/list', name: 'public_games_list')]
        public function gameList(PersistenceRegistry $doctrine): Response
        {
            $em = $doctrine->getManager();

            $onePlayerGames = $em->getRepository(Games::class)->findBy(
                ['numberOfPlayers' => 1]
            );

            $twoPlayersGames = $em->getRepository(Games::class)->findBy(
                ['numberOfPlayers' => 2],
            );

            $threePlayersGames = $em->getRepository(Games::class)->findBy(
                ['numberOfPlayers' => 3]
            );

            $forPlayersGames = $em->getRepository(Games::class)->findBy(
                ['numberOfPlayers' => 4]
            );

            return $this->render('public/gamesList.html.twig', [
                'onePlayerGames' => $onePlayerGames,
                'twoPlayersGames' => $twoPlayersGames,
                'threePlayersGames' => $threePlayersGames,
                'forPlayersGames' => $forPlayersGames,
            ]);
        }
    }