<?php

    namespace App\Controller\Admins;

    use App\Entity\Tables\Admins\Games;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Doctrine\Persistence\ManagerRegistry as PersistenceRegistry;

    class AdminGamesListController extends AbstractController
    {
        #[Route(path: '/admin/games/list', name: 'admin_games_list')]
        #[IsGranted('ROLE_ADMIN')]
        public function gamesList(PersistenceRegistry $doctrine): Response
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

            return $this->render('admins/gamesList.html.twig', [
                'onePlayerGames' => $onePlayerGames,
                'twoPlayersGames' => $twoPlayersGames,
                'threePlayersGames' => $threePlayersGames,
                'forPlayersGames' => $forPlayersGames,
            ]);
        }
    }