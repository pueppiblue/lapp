<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 25.11.15
 * Time: 15:33
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    public function listBooksAction()
    {
        $books = $this->getBookList();
        return $this->render('book/booklist.html.twig', array('books'=>$books));
    }

    private function getBookList(){
        // return array mit Booklist aus db
//        $books = $this
//            ->getDoctrine()
//            ->getRepository('AppBundle:Book')
//            ->findAll();
        $books = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Book')
            ->findAllOrderedByTitle();
        return $books;

    }

    private function addBook(){
        $book = new Book();
        $book->setISBN('12345');
        $book->setAuthor('Graf Zahl');
        $book->setTitle('Lust am Stricken');

        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();
    }
}