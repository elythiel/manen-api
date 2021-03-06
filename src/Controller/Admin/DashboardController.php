<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Concert;
use App\Entity\GalleryImage;
use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        /** @var AdminUrlGenerator $routeBuilder */
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(AlbumCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Manen Api')
            ->setFaviconPath('/images/favicon.png')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Albums');
        yield MenuItem::linkToCrud('Albums', 'fas fa-compact-disc', Album::class);
        yield MenuItem::linkToCrud('Songs', 'fas fa-music', Song::class);

        yield MenuItem::section('Concerts');
        yield MenuItem::linkToCrud('Concerts', 'fas fa-calendar-day', Concert::class);

        yield MenuItem::section('Galerie');
        yield MenuItem::linkToCrud('Galerie', 'fas fa-file-image', GalleryImage::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('css/admin.css')
        ;
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
        ;
    }
}
