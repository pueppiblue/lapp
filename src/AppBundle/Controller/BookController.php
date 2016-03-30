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
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();
    }
}
