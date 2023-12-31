<?php

    namespace App\Controller\HomeController;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class IndexController extends AbstractController
    {
        #[Route(path: '/', name: 'home_page')]
        public function index(): Response
        {
            return $this->render('index.html.twig');
        }
    }