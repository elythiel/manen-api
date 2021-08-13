<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=SongRepository::class)
 * @HasLifecycleCallbacks
 */
class Song
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $spotify;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lyrics;

    /**
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="songs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $album;

    /**
     * @ORM\Column(type="integer")
     */
    private $trackId;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $authors = [];

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $guests = [];

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function __toString(): string {
        return $this->getTitle();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getSpotify(): ?string
    {
        return $this->spotify;
    }

    public function setSpotify(?string $spotify): self
    {
        $this->spotify = $spotify;

        return $this;
    }

    public function getLyrics(): ?string
    {
        return $this->lyrics;
    }

    public function setLyrics(string $lyrics): self
    {
        $this->lyrics = $lyrics;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getTrackId(): ?int
    {
        return $this->trackId;
    }

    public function setTrackId(int $trackId): self
    {
        $this->trackId = $trackId;

        return $this;
    }

    public function getAuthors(): string
    {
        return implode(',', $this->authors);
    }

    public function setAuthors($authors): self
    {
        if(is_string($authors)) {
            $authors = explode(',', $authors);
        }
        $this->authors = $authors;

        return $this;
    }

    public function getGuests(): string
    {
        return implode(',', $this->guests);
    }

    public function setGuests($guests): self
    {
        if(is_string($guests)) {
            $guests = explode(',', $guests);
        }
        $this->guests = $guests;

        return $this;
    }
}
