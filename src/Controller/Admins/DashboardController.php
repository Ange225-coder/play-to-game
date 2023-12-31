<?php

    namespace App\Controller\Admins;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class DashboardController extends AbstractController
    {
        #[Route('/admin/dashboard', name: 'admin_dashboard')]
        #[IsGranted('ROLE_ADMIN')]
        public function dashboard(): Response
        {
            return $this->render('admins/dashboard.html.twig');
        }
    }