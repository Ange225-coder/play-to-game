<?php

    namespace App\Controller\Admins;

    use App\Entity\Tables\Admins\Admins;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Doctrine\Persistence\ManagerRegistry as PersistenceRegistry;
    use App\Entity\FormFields\Admins\RegistrationFields;
    use App\FormTypes\Admins\RegistrationTypes;
    use App\Security\AdminsAuthenticator;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

    class RegistrationController extends AbstractController
    {
        #[Route(path: '/admin/registration', name: 'admin_registration')]
        public function registration(Request $request, PersistenceRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, UserAuthenticatorInterface $authenticator, AdminsAuthenticator $formAuthenticator): Response
        {
            $em = $doctrine->getManager();

            $adminEntity = new Admins();

            $registrationField = new RegistrationFields();

            $registrationType = $this->createForm(RegistrationTypes::class, $registrationField);

            $registrationType->handleRequest($request);

            if($registrationType->isSubmitted() && $registrationType->isValid()) {
                $formData = $registrationType->getData();

                //checking existing username
                $existingUsername = $em->getRepository(Admins::class)->findOneBy([
                    'username' => $formData->getUsername(),
                ]);

                if($existingUsername) {
                    $registrationType->get('username')->addError(new FormError('Ce nom est déjà utilisé'));
                }

                if($registrationType->getErrors(true)->count() > 0) {
                    return $this->render('admins/registration.html.twig', [
                        'registration' => $registrationType->createView(),
                    ]);
                }

                $adminEntity->setUsername($formData->getUsername());
                $adminEntity->setPassword($passwordHasher->hashPassword($adminEntity, $formData->getPassword()));

                $em->persist($adminEntity);
                $em->flush();

                //authenticate admin here
                try {
                    $authenticator->authenticateUser($adminEntity, $formAuthenticator, $request);

                    return $this->redirectToRoute('admin_dashboard');
                }
                catch (CustomUserMessageAuthenticationException $e) {
                    $this->addFlash('error', $e->getMessage());

                    return $this->redirectToRoute('admin_registration');
                }
                catch (AuthenticationException) {
                    $this->addFlash('error', 'Une erreur est survenu');

                    return $this->redirectToRoute('admin_registration');
                }
            }

            return $this->render('admins/registration.html.twig', [
                'registration' => $registrationType->createView(),
            ]);
        }
    }