<?php

namespace App\Entity;

use App\Repository\GalleryImageRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=GalleryImageRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class GalleryImage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     *
     * @var Uuid
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_gallery"})
     *
     * @var string|null
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_gallery"})
     *
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="gallery_images", fileNameProperty="image")
     * @Assert\Image(
     *     maxSize="5M"
     * )
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime_immutable")
     *
     * @var DateTimeImmutable
     */
    private $createdAt;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

        if ($file) {
            $this->setCreatedAt();
        }

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
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
}
