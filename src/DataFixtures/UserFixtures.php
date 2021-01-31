<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {        
        $this->passwordEncoder = $passwordEncoder;;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("user@machin.fr")
             ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    'user'
                    ));
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("admin@machin.fr")
              ->setPassword($this->passwordEncoder->encodePassword(
                  $admin,
                  'admin'
              ))
              ->setRoles(['ROLE_ADMIN']);
              ;
        
        $manager->persist($admin);
        $manager->flush();
    }
}
