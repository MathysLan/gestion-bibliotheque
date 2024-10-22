<?php

namespace App\DataFixtures;

use App\Factory\AbonneFactory;
use App\Factory\AuteurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AuteurFactory::createMany(10);
    }
}
