<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new Product();
        $test->setName("Mon 1 er jeu");
        $test->setDescription("Il s'agit du premier jeu introduit en base");
        $manager->persist($test);

        $manager->flush();
    }
}
