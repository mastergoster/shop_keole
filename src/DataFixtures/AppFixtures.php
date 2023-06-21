<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Products;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Products();
            $product->setNom('product ' . $i);
            $product->setPrix(mt_rand(10, 100));
            $product->setDescription(
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do 
                eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco
                 laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                 dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                 fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                 non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            );
            $product->setPrix(mt_rand(10, 100));
            $product->setCreatedAt(new \DateTimeImmutable());
            $product->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($product);
        }

        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setNom('admin');
        $user->setPrenom('admin');

        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($user);

        $manager->flush();
    }
}
