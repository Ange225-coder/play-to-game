<?php

    namespace App\Controller\HomeController;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class AdminHomePageController extends AbstractController
    {
        #[Route(path: '/admin/home', name: 'admin_home')]
        public function adminIndex(): Response
        {
            return $this->render('admins/home.html.twig');
        }
    }