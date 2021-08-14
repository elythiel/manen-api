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
            ->setImage('etendues-perdues-6116a004ccb1e302234202.jpg')
            ->setReleasedAt(new \DateTime('2020-01-27'));

        $song = (new Song())
            ->setTrackId(1)
            ->setTitle('Etendues perdues')
            ->setYoutube('https://youtu.be/EIv2wnMjKkA')
            ->setSpotify('https://open.spotify.com/track/3zPjjtiP0Nt71WwNfjj0Oj?si=wZp38dNPSX2PxpaTf7-ggg')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"])
            ->setLyrics("<p>Il y a l&agrave; dans ce pays des steppes blanches</p>

<p>Immenses glac&eacute;es ou H&eacute;lios</p>

<p>Astre de la vie n&rsquo;a jamais sembl&eacute; r&eacute;gner</p>

<p>&nbsp;</p>

<p>Regarde...</p>

<p>Ces mers et ces vall&eacute;es fig&eacute;es</p>

<p>Gigantesques gorges arides</p>

<p>O&ugrave; des forteresses froides &eacute;rig&eacute;es</p>

<p>Par le givre et les si&egrave;cles</p>

<p>Tr&ocirc;nes, fi&egrave;res</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Attendons que les &acirc;mes mornes</p>

<p>Rejoignent enfin leurs terres</p>

<p>Attendons que les &acirc;mes mornes</p>

<p>Rejoignent enfin leurs terres&nbsp;</p>

<p>&nbsp;</p>

<p>Il y a l&agrave; derri&egrave;re ces gouffres</p>

<p>Derri&egrave;re ces constellations</p>

<p>Des neiges dures et de souffre</p>

<p>Les seuls esprits des nations</p>

<p>D&eacute;chues...</p>

<p>&nbsp;</p>

<p>Anciennes peuplades guerri&egrave;res</p>

<p>La rage mettant le feu</p>

<p>Aux derni&egrave;res poudri&egrave;res</p>

<p>Jusqu&#39;&agrave; leur dernier souffle Disparu...</p>

<p>&nbsp;</p>

<p>Attendons que les &acirc;mes mornes</p>

<p>Rejoignent enfin leurs terres</p>

<p>Attendons que les &acirc;mes mornes</p>

<p>Rejoignent enfin leurs terres</p>"
            );
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(2)
            ->setTitle('Voyage Pour La Gloire')
            ->setYoutube('https://youtu.be/5TSLwlo8RQ8')
            ->setSpotify('https://open.spotify.com/track/229LnisdLC9mMiS9yeIdWu?si=qtAaOUkjSq-l2zDMA-lBoA')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(3)
            ->setTitle('Vent De Guerre')
            ->setYoutube('https://youtu.be/oVzXXe8Da40')
            ->setSpotify('https://open.spotify.com/track/6wviXTl0vunETrccflcff0?si=dx6fzTJHRsKCZi9RfPSJqw')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(4)
            ->setTitle('Aux Abords De l\'Océan')
            ->setYoutube('https://youtu.be/hYsNfLw-sgo')
            ->setSpotify('https://open.spotify.com/track/65o7KjusuNf4fhTrEp247n?si=M4T2uEbeSUWF_fyNjCsn7Q')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(5)
            ->setTitle('Saison d\'Or')
            ->setYoutube('https://youtu.be/Q3mdRVytczI')
            ->setSpotify('https://open.spotify.com/track/6ny1DmrpK3J8og6vE5wtkz?si=HV-ev9TYTn60Bam2FKySQg')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(6)
            ->setTitle('Svarta Djup')
            ->setYoutube('https://youtu.be/62E-bJ-2Myo')
            ->setSpotify('https://open.spotify.com/track/1QAgVNRHIpTdGfkyJ177Z4?si=2sraPxG2TsWyf5DJlUM8cQ')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(7)
            ->setTitle('Le Navire')
            ->setYoutube('https://youtu.be/QHBHRjJLQDM')
            ->setSpotify('https://open.spotify.com/track/5MaZN6gESfEDF3ErKNPLSb?si=hxsvipWUSvu51G50pST60w')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(8)
            ->setTitle('Maudit Sabbat')
            ->setYoutube('https://youtu.be/tL52G5a1_Tg')
            ->setSpotify('https://open.spotify.com/track/0lZY0UBBS9zgIKCe537lZR?si=lrbhoaNMSn-YBqjsphm9_w')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $song = (new Song())
            ->setTrackId(9)
            ->setTitle('Ardente Saison')
            ->setYoutube('https://youtu.be/scLotLoMKiU')
            ->setSpotify('https://open.spotify.com/track/4TS8eCXkFl0aqaoewdnVBH?si=C1xnCbPxTeq_clafB1WtSA')
            ->setAuthors(["R. Meurtin", "T. Meurtin", "T. Gaudinet"]);
        $album->addSong($song);

        $manager->persist($album);
        $manager->flush();
    }
}
