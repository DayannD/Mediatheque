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
        //Je crée un utilisateur de test avec le rôle admin pour me connecter
        $user->setEmail('test@test.com')
             ->setLastname('Robert')
             ->setBornDate($date)
             ->setRoles(['ROLE_ADMIN'])
             ->setPassword('password')
            ;

            $password = $this->encoder->encodePassword($user, 'password');
             $user->setPassword($password);

        $users[] = $user;
        $manager->persist($user);

        //Je crée des utilisateur
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
        //les Livres
        $livres = [];
        for($i = 0; $i < 30; $i++){
            
            $livre = new Livre();

            $livre->setTitle($faker->word(2,true))
                  ->setAuteur($faker->name())
                  ->setDateParution($faker->dateTime())
                  ->setDescription($faker->paragraph(4))
                  ->setFile('livre_images.jpg')
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

        // et pour finir quelque emprunt
        for($i = 0; $i < 10; $i++){

            $emprunt = new Emprunt();

            $emprunt->setEmail($faker->unique()->randomElement($users))
                    ->setNameLivre($faker->unique()->randomElement($livres))
                    ->setDateEmprunt($faker->dateTime())
                    ->setIsRendering($faker->boolean())
                    ->setIsLoan($faker->boolean())
                    ;
        
        $manager->persist($emprunt);
        } 
        //je persist toute les données ,puis je les envoye à ma bdd avec le $symfony console d:f:l
        $manager->flush();
    }
}
