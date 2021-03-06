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
     * @Groups({"get_album_songs"})
     *
     * @var Uuid
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_album_songs"})
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_album_songs"})
     *
     * @var string|null
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_album_songs"})
     *
     * @var string|null
     */
    private $spotify;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"get_album_songs", "get_song_lyrics"})
     *
     * @var string|null
     */
    private $lyrics;

    /**
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="songs")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Album|null
     */
    private $album;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get_album_songs"})
     *
     * @var int
     */
    private $trackId;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"get_album_songs"})
     *
     * @var string[]
     */
    private $authors = [];

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"get_album_songs"})
     *
     * @var string[]
     */
    private $guests = [];

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function __toString(): string
    {
        return $this->getTrackId().'. '.$this->getTitle();
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

    public function getAuthors(): ?string
    {
        return !empty($this->authors)
            ? implode(',', $this->authors)
            : null;
    }

    /**
     * @param string[]|string $authors
     *
     * @return $this
     */
    public function setAuthors(mixed $authors): self
    {
        if (is_string($authors)) {
            $authors = explode(',', $authors);
        }
        $this->authors = $authors;

        return $this;
    }

    public function getGuests(): ?string
    {
        return !empty($this->guests)
            ? implode(',', $this->guests)
            : null;
    }

    /**
     * @param string[]|string $guests
     *
     * @return $this
     */
    public function setGuests(mixed $guests): self
    {
        if (is_string($guests)) {
            $guests = explode(',', $guests);
        }
        $this->guests = $guests;

        return $this;
    }
}
