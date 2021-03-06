<?php

namespace App\Form;

use App\Entity\Song;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('trackId', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('youtube', UrlType::class)
            ->add('spotify', UrlType::class)
            ->add('authors', TextType::class, [
                'help' => 'Auteurs, séparés par des virgules',
            ])
            ->add('guests', TextType::class, [
                'help' => 'Invités, séparés par des virgules',
            ])
            ->add('lyrics', CKEditorType::class, [
                'config' => ['song_lyrics'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
            'allow_add' => true,
            'allow_delete' => false,
            'delete_empty' => false,
            'entry_options' => [],
        ]);
    }
}
