<?php

namespace App\DataFixtures;

use App\Factory\AbonneFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AbonneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AbonneFactory::createMany(2);
    }
}
