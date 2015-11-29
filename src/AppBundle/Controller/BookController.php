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

    public function newAction()
    {
        $book = new Book();
        $book->setTitle('new_booktitle');

        $form = $this->createFormBuilder($book)
            ->add('title', 'text')
            ->add('isbn','text')
            ->add('author','text')
            ->add('save','submit',array('label' => 'Add book!'))
            ->getForm();

        return $this->render('book/bookCreateForm.html.twig',array('form' => $form->createView()));
    }

    private function newBook($title, $author = '', $isbn = '')
    {
        $book = new Book();
        $book->setTitle($title)
            ->setAuthor($author)
            ->setIsbn($isbn);
        return $book;
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