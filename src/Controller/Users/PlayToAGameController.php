<?php

    namespace App\Controller\Users;

    use App\Entity\Tables\Admins\Games;
    use App\Entity\Tables\Users\Players;
    use App\Entity\Tables\Users\Users;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\Persistence\ManagerRegistry as Doctrine;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use App\Entity\FormFields\Users\GameNicknameFormFields;
    use App\FormTypes\Users\GameNicknameFormTypes;

    class PlayToAGameController extends AbstractController
    {
        #[Route(path: '/user/game/play/{id_game}', name: 'user_game_registration')]
        #[IsGranted('ROLE_USER')]
        public function playToAGame($id_game, Doctrine $doctrine, Request $request): Response
        {
            $game = $doctrine->getRepository(Games::class)->find($id_game);

            $currentUser = $doctrine->getRepository(Users::class)->findOneBy([
                'pseudonyme' => $this->getUser()->getUserIdentifier(),
            ]);

            //get gameNickname based on user logged
            $gameNickname = $doctrine->getRepository(Players::class)->findOneBy([
                'user' => $currentUser->getPseudonyme(),
            ]);

            $playersEntity = new Players();

            //game pseudo form
            $nicknameFields = new GameNicknameFormFields();

            $nicknameTypes = $this->createForm(GameNicknameFormTypes::class, $nicknameFields);

            $nicknameTypes->handleRequest($request);

            if($nicknameTypes->isSubmitted() && $nicknameTypes->isValid()) {
                $formData = $nicknameTypes->getData();

                //get gameNickname based on game nickname
                $gamePseudo = $doctrine->getRepository(Players::class)->findOneBy([
                    'gameNickname' => $formData->getGameNickname(),
                ]);

                //verify if game nickname is different that user pseudonyme
                if($currentUser->getPseudonyme() === $formData->getGameNickname()) {
                    $nicknameTypes->get('gameNickname')->addError(new FormError('Entrer un nom de jeu différent de votre pseudonyme initial'));
                }

                if($gamePseudo) {
                    $nicknameTypes->get('gameNickname')->addError(new FormError('Nom de jeux déjà utilisé'));
                }

                if($nicknameTypes->getErrors(true)->count() > 0) {
                    return $this->render('users/playToAGame.html.twig', [
                        'game' => $game,
                        'nicknameForm' => $nicknameTypes->createView()
                    ]);
                }

                if($gamePseudo) {
                    return $this->redirectToRoute('user_game_start', ['id_game' => $game->getId()]);
                }
                else {
                    $em = $doctrine->getManager();

                    $playersEntity->setUser($currentUser->getPseudonyme());
                    $playersEntity->setGameNickname($formData->getGameNickname());
                    $playersEntity->setUserLevel($currentUser->getCurrentLevel());
                    $playersEntity->setGameName($game->getName());
                    $playersEntity->setGameLevel($game->getRequiredLevel());
                    $playersEntity->setRegistrationDate(new \DateTime());

                    $em->persist($playersEntity);
                    $em->flush();

                    return $this->redirectToRoute('user_game_start', ['id_game' => $game->getId()]);
                }
            }

            return $this->render('users/playToAGame.html.twig', [
                'game' => $game,
                'nicknameForm' => $nicknameTypes->createView(),
                'gameNickname' => $gameNickname,
                'user' => $currentUser,
            ]);
        }
    }