<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 25.11.15
 * Time: 15:33
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Exception\BookRepositoryException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BookController extends Controller
{
    /**
     * @param string $id
     * @return Response
     */
    public function viewBookAction($id)
    {
        $book = $this->getBook($id);
        return $this->render('book/bookview.html.twig', array('book' => $book));
    }

    /**
     * @return Response
     */
    public function listBooksAction()
    {
        $books = $this->getBookList();
        return $this->render('book/booklist.html.twig', array('books' => $books));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
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

        if ($form->isValid()) {
            $this->addBookToModel($book);
            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/bookCreateForm.html.twig', array('form' => $form->createView()));
    }

    /**
     * @return Book[]
     */
    private function getBookList()
    {
        //todo Nils refactor to a domain handler
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

    /**
     * @param string $id
     * @return Book
     */
    private function getBook($id)
    {
        //todo Nils refactor to a domain handler
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Book');
        try {
            $book = $repository->findOneById($id);
        } catch (BookRepositoryException $e) {
            throw new NotFoundHttpException('The book you were searching for was not found.', $e);
        }
        return $book;
    }

    /**
     * @param Book $book
     */
    private function addBookToModel(Book $book)
    {
        //todo Nils refactor to a domain handler
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();
    }
}