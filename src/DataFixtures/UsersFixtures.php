<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class UsersFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('testuser');
        $user->setEmail('testuser@example.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'secret'));
        $user->setRoles(['ROLE_USER']);
        $user->setUuid(Uuid::v4()->toRfc4122());

        $manager->persist($user);
        $manager->flush();
    }
}
