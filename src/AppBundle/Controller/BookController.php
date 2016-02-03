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
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BookController extends Controller
{
    /**
     * @param string $id
     *
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
     *
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
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function editBookAction(Request $request)
    {
        $book = $this->getBook($request->get('id'));

        $form = $this->createForm('app_addBook', $book);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->addBookToModel($book);

            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/bookCreateForm.html.twig', array('form' => $form->createView()));
    }

    /**
     * @return Response
     */
    public function loadBookFixturesAction()
    {
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'doctrine:fixtures:load',
            '--append' => '',
            '--fixtures' => sprintf(
                '%s%s',
                $kernel->getRootDir(),
                '/../src/AppBundle/DataFixtures/ORM/LoadBookData.php'
            ),
        ));

        $output = new BufferedOutput();

        try {
            $application->run($input, $output);

            $content = $output->fetch();
            $this->addFlash('info', $content);
        } catch (\Exception $e) {
            $this->addFlash('info', 'command failed with: ' . $e->getMessage());
        }

        return $this->redirectToRoute('book_list');
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
     *
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
