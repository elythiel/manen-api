<?php

namespace App\Controller\Admin;

use App\Entity\Concert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ConcertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Concert::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Action::INDEX, 'Liste des concerts')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Nom de l\'évenement'),
            DateTimeField::new('date')->setLabel('Date et heure'),
            TextField::new('location')->setLabel('Lieu'),
            UrlField::new('purchaseLink')->setLabel('Lien d\'achat'),
            UrlField::new('moreLink')->setLabel('Lien "Plus d\'informations"'),
        ];
    }
}
