<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)$
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @Groups({"get_albums"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_albums", "get_song"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_albums"})
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_albums"})
     */
    private $spotify;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_albums"})
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="album_images", fileNameProperty="image")
     * @Assert\Image()
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity=Song::class, mappedBy="album", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"trackId" = "ASC"})
     */
    private $songs;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_albums"})
     */
    private $releasedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->songs = new ArrayCollection();
        $this->updatedAt = new \DateTime();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $file): self
    {
        $this->imageFile = $file;

        if($file) {
            $this->setUpdatedAt();
        }

        return $this;
    }

    /**
     * @return Collection|Song[]
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs[] = $song;
            $song->setAlbum($this);
        }

        return $this;
    }

    public function removeSong(Song $song): self
    {
        if ($this->songs->removeElement($song)) {
            // set the owning side to null (unless already changed)
            if ($song->getAlbum() === $this) {
                $song->setAlbum(null);
            }
        }

        return $this;
    }

    public function getCountSongs(): int
    {
        return count($this->songs);
    }

    public function getReleasedAt(): ?\DateTimeInterface
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(\DateTimeInterface $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new DateTimeImmutable();

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new DateTimeImmutable();
        return $this;
    }
}
