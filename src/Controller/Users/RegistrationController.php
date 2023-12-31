<?php

    namespace App\Controller\Users;

    use App\Entity\Tables\Users\Users;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\Persistence\ManagerRegistry as Doctrine;
    use App\Entity\FormFields\Users\RegistrationFields;
    use App\FormTypes\Users\RegistrationTypes;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use App\Security\UsersAuthenticator;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

    class RegistrationController extends AbstractController
    {
        #[Route(path: '/user/registration', name: 'user_registration')]
        public function userRegistration(Request $request, Doctrine $doctrine, UserPasswordHasherInterface $passwordHasher, UserAuthenticatorInterface $authenticator, UsersAuthenticator $formAuthenticator): Response
        {
            $em = $doctrine->getManager();

            $userEntity = new Users();
            $registrationFields = new RegistrationFields();

            $registrationTypes = $this->createForm(RegistrationTypes::class, $registrationFields);

            $registrationTypes->handleRequest($request);

            if($registrationTypes->isSubmitted() && $registrationTypes->isValid()) {
                $formData = $registrationTypes->getData();

                $existingPseudonyme = $em->getRepository(Users::class)->findOneBy([
                    'pseudonyme' => $formData->getPseudonyme(),
                ]);

                $existingEmail = $em->getRepository(Users::class)->findOneBy([
                    'email' => $formData->getEmail(),
                ]);

                if($existingPseudonyme) {
                    $registrationTypes->get('pseudonyme')->addError(new FormError('Ce pseudonyme est déjà utilisé'));
                }

                if($existingEmail) {
                    $registrationTypes->get('email')->addError(new FormError('Cet email est déjà utilisé'));
                }

                if($registrationTypes->getErrors(true)->count() > 0) {
                    return $this->render('users/registration.html.twig', [
                        'registration' => $registrationTypes->createView(),
                    ]);
                }

                $userEntity->setPseudonyme($formData->getPseudonyme());
                $userEntity->setEmail($formData->getEmail());
                $userEntity->setCurrentLevel($formData->getCurrentLevel());
                $userEntity->setPassword($passwordHasher->hashPassword($userEntity, $formData->getPassword()));

                $em->persist($userEntity);
                $em->flush();

                //authenticate user here
                try {
                    $authenticator->authenticateUser($userEntity, $formAuthenticator, $request);

                    return $this->redirectToRoute('public_games_list');
                }
                catch (CustomUserMessageAuthenticationException $e) {
                    $this->addFlash('error', $e->getMessage());

                    return $this->redirectToRoute('user_registration');
                }
                catch(AuthenticationException) {
                    $this->addFlash('error', 'Une erreur est survenue');

                    return $this->redirectToRoute('user_registration');
                }
            }

            return $this->render('users/registration.html.twig', [
                'registration' => $registrationTypes->createView(),
            ]);
        }
    }