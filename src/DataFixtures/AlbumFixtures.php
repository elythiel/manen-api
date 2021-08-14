<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $album = new Album();
        $album
            ->setTitle('Etendues perdues')
            ->setYoutube('https://youtu.be/EIv2wnMjKkA?list=OLAK5uy_k6g1w8k48200fuwvrMQU3PzW7LJS0wwaI')
            ->setSpotify('https://open.spotify.com/album/5lFSsYs15Uxo0iGdoWJvGB?si=j8DrwfUHTqyKLHbVZV6GSA')
            ->setImage('https://manen-music.fr/_nuxt/img/etendues-perdues.6796286.jpg')
            ->setReleasedAt(new \DateTime('2020-01-27'));

        $song = (new Song())
            ->setTrackId(1)
            ->setTitle('Etendues perdues')
            ->setYoutube('EIv2wnMjKkA')
            ->setSpotify('https://open.spotify.com/track/3zPjjtiP0Nt71WwNfjj0Oj?si=wZp38dNPSX2PxpaTf7-ggg')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(2)
            ->setTitle('Voyage Pour La Gloire')
            ->setYoutube('5TSLwlo8RQ8')
            ->setSpotify('https://open.spotify.com/track/229LnisdLC9mMiS9yeIdWu?si=qtAaOUkjSq-l2zDMA-lBoA')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(3)
            ->setTitle('Vent De Guerre')
            ->setYoutube('oVzXXe8Da40')
            ->setSpotify('https://open.spotify.com/track/6wviXTl0vunETrccflcff0?si=dx6fzTJHRsKCZi9RfPSJqw')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(4)
            ->setTitle('Aux Abords De l\'Océan')
            ->setYoutube('hYsNfLw-sgo')
            ->setSpotify('https://open.spotify.com/track/65o7KjusuNf4fhTrEp247n?si=M4T2uEbeSUWF_fyNjCsn7Q')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(5)
            ->setTitle('Saison d\'Or')
            ->setYoutube('Q3mdRVytczI')
            ->setSpotify('https://open.spotify.com/track/6ny1DmrpK3J8og6vE5wtkz?si=HV-ev9TYTn60Bam2FKySQg')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(6)
            ->setTitle('Svarta Djup')
            ->setYoutube('62E-bJ-2Myo')
            ->setSpotify('https://open.spotify.com/track/1QAgVNRHIpTdGfkyJ177Z4?si=2sraPxG2TsWyf5DJlUM8cQ')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(7)
            ->setTitle('Le Navire')
            ->setYoutube('QHBHRjJLQDM')
            ->setSpotify('https://open.spotify.com/track/5MaZN6gESfEDF3ErKNPLSb?si=hxsvipWUSvu51G50pST60w')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(8)
            ->setTitle('Maudit Sabbat')
            ->setYoutube('tL52G5a1_Tg')
            ->setSpotify('https://open.spotify.com/track/0lZY0UBBS9zgIKCe537lZR?si=lrbhoaNMSn-YBqjsphm9_w')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(9)
            ->setTitle('Ardente Saison')
            ->setYoutube('scLotLoMKiU')
            ->setSpotify('https://open.spotify.com/track/4TS8eCXkFl0aqaoewdnVBH?si=C1xnCbPxTeq_clafB1WtSA')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $manager->persist($album);
        $manager->flush();
    }
}
