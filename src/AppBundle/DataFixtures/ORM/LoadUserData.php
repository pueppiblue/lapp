<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 26.11.15
 * Time: 16:40
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager){
        $userAdmin = new User();
        $userAdmin
            ->setUsername('admin')
            ->setPassword('admin')
            ->setIsActive(true);

        $manager
            ->persist($userAdmin)
            ->flush();
    }
}