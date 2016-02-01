<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 26.11.15
 * Time: 17:00
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Book;

class LoadBookData implements FixtureInterface
{
    /**
     * implements interface method load()
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $om){
        $book = new Book();
        $book
            ->setIsbn('123456')
            ->setAuthor('Frau Holle')
            ->setPrice(47.11)
            ->setTitle('Kissen schütteln leicht gemacht');

        $om->persist($book);

        $book = new Book();
        $book
            ->setIsbn('7836')
            ->setAuthor('Inet Held 85')
            ->setPrice(47.11)
            ->setTitle('Symfony for checkers');
        $om->persist($book);

        $book = new Book();
        $book
            ->setIsbn('8787878')
            ->setAuthor('Dieter Scherenhand')
            ->setPrice(47.11)
            ->setTitle('Die wundervolle Welt des Häkelns');
        $om->persist($book);
        $om->flush();
    }

}
