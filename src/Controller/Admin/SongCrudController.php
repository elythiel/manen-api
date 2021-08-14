<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class SongCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Song::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return Actions::new()
            ->add(Crud::PAGE_INDEX, Action::EDIT)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('album.title')
                ->setLabel('Album')
                ->hideOnForm(),
            IdField::new('id')->hideOnForm(),
            IntegerField::new('trackId')
                ->hideOnForm(),
            TextField::new('title'),
            UrlField::new('youtube'),
            UrlField::new('spotify'),
            TextField::new('authors')
                ->setHelp('Auteurs, séparés par des virgules'),
            TextField::new('guests')
                ->setHelp('Invités, séparés par des virgules'),
            TextareaField::new('lyrics')
                ->setFormType(CKEditorType::class)
                ->setFormTypeOptions([
                    'config' => ['song_lyrics']
                ])
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('album')
            ->add('authors');
    }
}
