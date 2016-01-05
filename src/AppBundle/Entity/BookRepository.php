<?php

namespace AppBundle\Entity;

use AppBundle\Exception\BookRepositoryException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends EntityRepository
{
    /**
     * @return Book[]
     */
    public function findAllOrderedByTitle()
    {
//        $query = $this->getEntityManager()
//            ->createQuery(
//                'Select b FROM AppBundle:Book b ORDER BY b.title ASC'
//            );
        $query = $this->createQueryBuilder('b')
            ->orderBy('b.title', 'ASC')
            ->getQuery();
        return $query->getResult();
    }

    /**
     * @param $id
     * @return Book
     * @throws BookRepositoryException
     */
    public function findOneById($id)
    {
        $query = $this->createQueryBuilder('b')
            ->where('b.id = :parID')
            ->setParameter('parID', $id)
            ->getQuery();
        try {
            $book = $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new BookRepositoryException('Book not found by ID', null, $e);
        } catch (NonUniqueResultException $e) {
            throw new BookRepositoryException('Found several books by ID', null, $e);
        }

        return $book;
//        $book = $this->findOneBy($id);
//        return $book;
    }

}
