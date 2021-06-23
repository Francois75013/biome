<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use App\Entity\Quiz;
use App\Entity\Reponses;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Biom - Back-office');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Questions', 'fas fa-list', Questions::class);
        yield MenuItem::linkToCrud('Quiz', 'fas fa-list', Quiz::class);
        yield MenuItem::linkToCrud('Reponses', 'fas fa-list', Reponses::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }
}
