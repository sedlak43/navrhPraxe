<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Vytvoření administrátorského uživatele
        $adminUser = new User();
        $adminUser->setEmail('admin@cestovka.vspj.cz');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, '2IFn9hSVtNU8Jkw'));

        $manager->persist($adminUser);
        $manager->flush();
    }
}
