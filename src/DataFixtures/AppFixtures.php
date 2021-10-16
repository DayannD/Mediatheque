<?php

namespace App\DataFixtures;

use App\Entity\Emprunt;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\User;
use DateTime;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        
        $date = new DateTime();
        $user = new User();
        $users= [];
        
        $user->setEmail('test@test.gmail')
             ->setLastname('Robert')
             ->setBornDate($date)
             ->setRoles(['ROLE_ADMIN'])
            ;

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);


        for($i = 0; $i < 10; $i++){

            $date = new DateTime();
            $user = new User();

            $user->setEmail($faker->email())
                ->setLastname($faker->name())
                ->setBornDate($faker->dateTime())
                ->setRoles(['ROLE_USER'])
                ;
            $password = $this->encoder->encodePassword($user, $faker->password());
            $user->setPassword($password);

            $users[] = $user;
            $manager->persist($user);

        }

        $livres = [];
        for($i = 0; $i < 30; $i++){
            
            $livre = new Livre();

            $livre->setTitle($faker->name())
                  ->setDateParution($faker->dateTime())
                  ->setDescription($faker->paragraph(4))
                  ->setFile($faker->mimeType())
                  ->setDispo($faker->boolean())
                  ->setGenre($faker->randomElement([
                      'Romans',
                      'Policier',
                      'Autobiographique',
                      'Amour',
                      'fiction',
                      'thriller',
                      ]))
                  ;
            $livres[] = $livre;
            $manager->persist($livre);
        }


        for($i = 0; $i < 10; $i++){

            $emprunt = new Emprunt();

            $emprunt->setEmail($faker->unique()->randomElement($users))
                    ->setNameLivre($faker->unique()->randomElement($livres))
                    ->setDateEmprunt($faker->dateTime())
                    ;
        
        $manager->persist($emprunt);
        } 

        $manager->flush();
    }
}