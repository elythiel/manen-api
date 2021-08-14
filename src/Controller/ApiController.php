<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\GalleryImageRepository;
use App\Repository\SongRepository;
use App\Serializer\Normalizer\AlbumNormalizer;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class ApiController extends AbstractController
{
    /**
     * @Route("/albums", name="api_get_albums", methods={"GET"}, format="json")
     */
    public function getAlbums(AlbumRepository $albumRepository): JsonResponse
    {
        $albums = $albumRepository->findAll();
        return $this->json($albums, Response::HTTP_OK, [], [
            'groups' => 'get_albums'
        ]);
    }

    /**
     * @Route("/albums/{id}/songs", name="api_get_album_songs", methods={"GET"}, format="json")
     */
    public function getAlbumSongs(SongRepository $songRepository, Request $request, $id): JsonResponse
    {
        if (!Uuid::isValid($id)) {
            return $this->json(null, Response::HTTP_BAD_REQUEST);
        }
        // get song from DB
        $songs = $songRepository->findBy(
            ['album' => $id],
            ['trackId' => 'asc']
        );
        return $this->json($songs, Response::HTTP_OK, [], [
            'groups' => 'get_album_songs'
        ]);
    }

    /**
     * @Route("/gallery", name="api_get_gallery_images", methods={"GET"}, format="json")
     */
    public function getGalleryImages(GalleryImageRepository $galleryImageRepository): JsonResponse
    {
        $images = $galleryImageRepository->findAll();
        return $this->json($images, Response::HTTP_OK, [], [
            'groups' => 'get_gallery'
        ]);
    }

}
