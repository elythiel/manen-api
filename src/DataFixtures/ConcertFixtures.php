<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ConcertFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i = 0; $i < 30; $i++) {
            $concert = (new Concert())
                ->setTitle($faker->text(50))
                ->setDate($faker->dateTimeBetween('-2years', '+2years'))
                ->setLocation($faker->text(30));
            if($faker->boolean()) {
                $concert->setMoreLink($faker->url);
            }
            if($faker->boolean()) {
                $concert->setPurchaseLink($faker->url);
            }

            $manager->persist($concert);
        }

        $manager->flush();
    }
}
