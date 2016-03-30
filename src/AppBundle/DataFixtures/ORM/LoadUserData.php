<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 26.11.15
 * Time: 16:40
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager){
        $user = new User();
        $user
            ->setUsername('admin')
            ->setPassword('admin')
            ->setActive(true);
        $manager->persist($user);

        $user = new User();
        $user
            ->setUsername('Bücherwurm84')
            ->setPassword('readforlife')
            ->setActive(true);
        $manager->persist($user);

        $manager->flush();
    }
}
