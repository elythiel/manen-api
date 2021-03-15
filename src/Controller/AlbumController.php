<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{

    /**
     * @Route("/albums", name="albums")
     */
    public function findAll(): Response {
        $repository = $this->getDoctrine()->getRepository(Album::class);
        $albums = $repository->findAll();

        return $this->json($albums);
    }
}
