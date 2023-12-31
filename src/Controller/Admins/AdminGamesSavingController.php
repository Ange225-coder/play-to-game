<?php

    namespace App\Controller\Admins;

    use App\Entity\Tables\Admins\Games;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry as PersistenceRegistry;
    use App\FormTypes\Admins\GamesSavingTypes;
    use App\Entity\FormFields\Admins\GamesSavingFields;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class AdminGamesSavingController extends AbstractController
    {
        #[Route(path: '/admin/games/saving', name: 'admin_games_saving')]
        #[IsGranted('ROLE_ADMIN')]
        public function gamesSaving(Request $request, PersistenceRegistry $doctrine): Response
        {
            $gamesEntity = new Games();
            $savingFields = new GamesSavingFields();

            $em = $doctrine->getManager();

            $savingTypes = $this->createForm(GamesSavingTypes::class, $savingFields);

            $savingTypes->handleRequest($request);

            if($savingTypes->isSubmitted() && $savingTypes->isValid()) {
                $formData = $savingTypes->getData();

                $gamesEntity->setName($formData->getName());
                $gamesEntity->setType($formData->getType());
                $gamesEntity->setRequiredLevel($formData->getRequiredLevel());
                $gamesEntity->setNumberOfPlayers($formData->getNumberOfPlayers());

                $em->persist($gamesEntity);
                $em->flush();

                return $this->redirectToRoute('admin_dashboard');
            }

            return $this->render('admins/gameSaving.html.twig', [
                'saving' => $savingTypes->createView(),
            ]);
        }
    }