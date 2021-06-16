<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
      /**
     * @Route("/page_parents", name="page_parents")
     */
    public function parents(): Response
    {
        return $this->render('page_parents/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    public function cgu(): Response
    {
        return $this->render('cgu/cgu.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
