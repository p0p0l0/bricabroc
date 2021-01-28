<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $jeu1 = new Product();
        $jeu1->setName("Mon 1 er jeu");
        $jeu1->setDescription("Il s'agit du premier jeu introduit en base");
        $manager->persist($jeu1);

        $jeu2 = new Product();
        $jeu2->setName("Mon 2 eme jeu");
        $jeu2->setDescription("voir si la boucle de card fonctionne");
        $manager->persist($jeu2);

        $jeu3 = new Product();
        $jeu3->setName("Mon 3 eme jeu");
        $jeu3->setDescription("alors la boucle??");
        $manager->persist($jeu3);

        $jeu4 = new Product();
        $jeu4->setName("Mon 4 eme jeu");
        $jeu4->setDescription("A la ligne ????");
        $manager->persist($jeu4);
        
        $manager->flush();
    }
}
