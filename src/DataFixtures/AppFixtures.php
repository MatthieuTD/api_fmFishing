<?php

namespace App\DataFixtures;

use App\Entity\Spots;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $spot = new Spots();

        // $manager->persist($product);

        $manager->flush();
    }
}
