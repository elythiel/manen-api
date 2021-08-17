<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AlbumFixtures extends Fixture
{
    public const IMAGE_DIR = 'public/uploads/albums';

    private $albumTracks = [9, 1, 15];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 3; ++$i) {
            $album = (new Album())
                ->setTitle($faker->text(50))
                ->setYoutube('https://youtu.be/EIv2wnMjKkA?list=OLAK5uy_k6g1w8k48200fuwvrMQU3PzW7LJS0wwaI')
                ->setSpotify('https://open.spotify.com/album/5lFSsYs15Uxo0iGdoWJvGB?si=j8DrwfUHTqyKLHbVZV6GSA')
                ->setReleasedAt($faker->dateTime())
            ;
            $cover = $faker->uuid.'.jpg';
            if ($this->saveRandomImage(self::IMAGE_DIR.'/'.$cover, 600, 600)) {
                $album->setImage($cover);
            }
            for ($track = 1; $track <= $this->albumTracks[$i]; ++$track) {
                $song = (new Song())
                    ->setTrackId($track)
                    ->setTitle($faker->text(50))
                    ->setYoutube('https://youtu.be/EIv2wnMjKkA')
                    ->setSpotify('https://open.spotify.com/track/3zPjjtiP0Nt71WwNfjj0Oj?si=wZp38dNPSX2PxpaTf7-ggg')
                ;
                $authors = [];
                for ($y = 0; $y < rand(1, 3); ++$y) {
                    $authors[] = $faker->name;
                }
                $song->setAuthors($authors);
                if ($faker->boolean()) {
                    $song->setGuests([$faker->name()]);
                }
                if ($faker->boolean()) {
                    $song->setLyrics($faker->randomHtml());
                }
                $album->addSong($song);
            }
            $manager->persist($album);
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
