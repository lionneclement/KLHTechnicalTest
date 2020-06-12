<?php

namespace App\DataFixtures;

use App\Entity\Recipes;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("user1@gmail.com");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'password'
            )
        );
        $manager->persist($user);

        $recipes = new Recipes();
        $recipes->setTitle("Title 1");
        $recipes->setDescription("Description 1");
        $recipes->setIngredients(["first", "second", "third"]);
        $recipes->setUser($user);
        
        $manager->persist($recipes);

        $user = new User();
        $user->setEmail("user2@gmail.com");
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'password'
            )
        );
        $manager->persist($user);

        $recipes = new Recipes();
        $recipes->setTitle("Title 2");
        $recipes->setDescription("Description 2");
        $recipes->setIngredients(["first", "second", "third"]);
        $recipes->setUser($user);

        $manager->persist($recipes);

        $manager->flush();
    }
}
