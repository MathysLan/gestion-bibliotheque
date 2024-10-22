<?php

namespace App\DataFixtures;

use App\Factory\LivreFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LivreFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        LivreFactory::createMany(10);
    }
}
