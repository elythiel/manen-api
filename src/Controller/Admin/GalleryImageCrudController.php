<?php

namespace App\Controller\Admin;

use App\Entity\GalleryImage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class GalleryImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GalleryImage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Action::INDEX, 'Galerie d\'images')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::EDIT);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('description'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                ])
                ->onlyOnForms(),
            ImageField::new('image')
                ->setBasePath('uploads/gallery/')
                ->onlyOnIndex(),
            DateTimeField::new('createdAt')
                ->hideOnForm()
                ->setLabel('Créé le'),
        ];
    }
}
