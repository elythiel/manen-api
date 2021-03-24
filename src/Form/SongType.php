<?php

namespace App\Form;

use App\Entity\Song;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('trackId', IntegerType::class, [
                'label' => 'N° de piste'
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('youtube', UrlType::class, [
                'label' => 'Lien Youtube'
            ])
            ->add('spotify', UrlType::class, [
                'label' => 'Lien Spotify'
            ])
            ->add('authors', TextType::class, [
                'label' => 'Auteurs',
                'help' => 'Auteurs, séparés par des virgules'
            ])
            ->add('guests', TextType::class, [
                'label' => 'Invités',
                'help' => 'Invités, séparés par des virgules'
            ])
            ->add('lyrics', TextareaType::class, [
                'label' => 'Paroles'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
            
            'allow_add' => true,
            'allow_delete' => false,
            'delete_empty' => false,
            'entry_options' => []
        ]);
    }

    public function onPostSetData(FormEvent $event)
    {
        dd($event);
        if ($event->getData() && $event->getData()->getId()) {
            $form = $event->getForm();
            // unset($form['user']);
        }
    }
}
