<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Form\SongType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AlbumCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Album::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            UrlField::new('youtube'),
            UrlField::new('spotify'),
            TextField::new('image'),
            DateField::new('releasedAt'),
            DateTimeField::new('createdAt')->hideOnForm(),
            CollectionField::new('songs')
                ->allowAdd(true)
                ->allowDelete(true)
                ->setFormType(CollectionType::class)
                ->setFormTypeOptions([
                    'entry_type' => SongType::class,
                    'allow_add' => true,
                    'allow_delete' => false,
                    'delete_empty' => false
                ])
        ];
    }
}
