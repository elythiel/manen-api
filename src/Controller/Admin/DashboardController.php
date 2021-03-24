<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Concert;
use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(AlbumCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle('Manen Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Albums');
        yield MenuItem::linkToCrud('Albums', 'fas fa-compact-disc', Album::class);
        yield MenuItem::linkToCrud('Titres', 'fas fa-music', Song::class);

        yield MenuItem::section('Concerts');
        yield MenuItem::linkToCrud('Concerts', 'fas fa-calendar-day', Concert::class);
    }

    public function configureAssets(): Assets
    {
        $assets = Assets::new()
            ->addCssFile('css/admin.css');
        return $assets;
    }
}
