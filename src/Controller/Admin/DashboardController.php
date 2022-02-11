<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Fishes;
use App\Entity\Spots;
use App\Entity\States;
use App\Entity\TypesGrounds;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Controller\Admin\SpotsCrudController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       // return parent::index();


         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(SpotsCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Api Fmfishing');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Spot', 'fa fa-user', Spots::class);
        yield MenuItem::linkToCrud('Fishes', 'fa fa-user', Fishes::class);
        yield MenuItem::linkToCrud('Type de sol', 'fa fa-user', TypesGrounds::class);
        yield MenuItem::linkToCrud('Catégorie de pêche', 'fa fa-user', Categories::class);
        yield MenuItem::linkToCrud('Etat privé ou public', 'fa fa-user', States::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);




    }
}
