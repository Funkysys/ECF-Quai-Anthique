<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Days;
use App\Entity\Dish;
use App\Entity\User;
use App\Entity\Allergy;
use App\Entity\Category;
use App\Entity\Formulas;
use App\Entity\Hours;
use App\Entity\Minutes;
use App\Entity\OpeningHours;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = Factory::create('Fr');

        $user = new User();
        $user->setEmail('admin@user.test')
            ->setName('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setAllergy([]);
        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);

        $manager->persist($user);

        $allergns = array('Gluten', 'Arachide', 'Lait', 'Oeufs', 'Fruits à coque', 'Mollusques', 'Fruits de mer', 'Moutarde', 'Poisson', 'Céleri', 'Soja', 'Sulfites', 'Sésame', 'Lupin');
        for ($i = 0; $i < sizeof($allergns); $i++) {
            //test article creation
            $allergy = new Allergy();

            $allergy->setName($allergns[$i]);
            $manager->persist($allergy);
        }

        $categories = array('Entrées', 'Plats', 'Désserts', 'Boissons');
        for ($i = 0; $i < sizeof($categories); $i++) {

            $category = new Category();
            $category->setTitle($categories[$i]);

            $manager->persist($category);

            for ($j = 0; $j < 3; $j++) {
                for ($j = 0; $j < 4; $j++) {
                    $dish = new Dish();
                    $dish->setCategory($category)
                        ->setDescription($faker->text(50))
                        ->setPrice($faker->randomDigit())
                        ->setTitle($faker->title());

                    $manager->persist($dish);
                }
            }
        }
        for ($i = 0; $i < 3; $i++) {
            $formulas = new Formulas();
            $formulas->setTitle($faker->title())
                ->setPrice($faker->randomDigit());
            $manager->persist($formulas);
        }

        $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        foreach ($days as $day) {
            $d = new Days();
            $d->setDay($day);
            $manager->persist($d);
        }

        $hours = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24);
        foreach ($hours as $hour) {
            $h= new Hours();
            $h->setHour($hour);
            $manager->persist($h);
        }

        $minutes = array(0, 15, 30, 45);
        foreach ($minutes as $minute) {
            $m= new Minutes();
            $m->setMinutes($minute);
            $manager->persist($m);
        }
    }
}
