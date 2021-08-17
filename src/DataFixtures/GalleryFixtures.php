<?php

namespace App\DataFixtures;

use App\Entity\GalleryImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GalleryFixtures extends Fixture
{
    public const IMAGE_DIR = 'public/uploads/gallery';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 15; ++$i) {
            $width = rand(400, 1200);
            $height = rand(400, 1200);
            $imageName = $faker->uuid.'.jpg';
            $imagePath = self::IMAGE_DIR.'/'.$imageName;
            if ($this->saveRandomImage($imagePath, $width, $height)) {
                $galleryImage = (new GalleryImage())
                    ->setDescription($faker->text(100))
                    ->setImage($imageName)
                ;
                $manager->persist($galleryImage);
            }
        }

        $manager->flush();
    }

    private function saveRandomImage(string $absolutePath, int $width = 640, int $height = 480): bool
    {
        // Create a blank image:
        $image = imagecreatetruecolor($width, $height);
        // Add light background color:
        $bgColor = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
        imagefill($image, 0, 0, $bgColor);

        // Save the image:
        $isGenerated = imagejpeg($image, $absolutePath);

        // Free up memory:
        imagedestroy($image);

        return $isGenerated;
    }
}
