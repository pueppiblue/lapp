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
use Symfony\Component\HttpFoundation\Request;


class BookController extends Controller
{
    public function listBooksAction()
    {
        $books = $this->getBookList();
        return $this->render('book/booklist.html.twig', array('books'=>$books));
    }

    public function newAction(Request $request)
    {
        $book = new Book();

          $form = $this->createForm('app_addBook', $book);

//        $form = $this->createForm(new BookType, $book);

//        $form = $this->createFormBuilder(
//            $book, array('validation_groups' => array('creation')))
//            ->add('title', 'text', array('required'=>false))
//            ->add('isbn','text', array('required'=>false))
//            ->add('author','text', array('required'=>false))
//            ->add('save','submit',array('label' => 'Add book!'))
//            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
            $this->addBookToModel($book);
            return $this->redirectToRoute('book_list');
        }

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

    private function addBookToModel(Book $book){
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();
    }
}