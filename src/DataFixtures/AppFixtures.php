<?php

namespace App\DataFixtures;

use App\Entity\Pointage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    /**
     * L'encodeur de mots de passe
     *
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($u = 0; $u < 10; $u++) {

            $user = new User();

            if($u == 0 ) {
                $roles=["ROLE_PATRON"];
            }
            else{
                $roles=["ROLE_OUVRIER"];
            }

            $user->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber)
                ->setRoles($roles)
                ->setPassword($this->encoder->hashPassword($user,"password"));

            $manager->persist($user);

            for ($i = 0; $i < mt_rand(3, 20); $i++) {

                $pointage = new Pointage();
                $pointage->setObservation($faker->text)
                    ->setDate($faker->dateTimeBetween('-3 months'))
                    ->setStatus("ok")
                    ->setStartHourAm($faker->dateTimeInInterval('',"+8 hour"))
                    ->setEndHourAm($a=($faker->dateTimeInInterval('',"+12 hours")))
                    ->setStartHourBreak($a)
                    ->setEndHourBreak($b=($faker->dateTimeInInterval("","+13 hours")))
                    ->setStartHourPm($b)
                    ->setEndHourPm($faker->dateTimeInInterval("","+16 hours"))
                    ->setUser($user);

                $manager->persist($pointage);
            }
        }

        $manager->flush();
    }
}