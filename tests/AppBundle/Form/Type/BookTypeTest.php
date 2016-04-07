<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 04.04.16
 * Time: 17:35
 */

namespace Tests\AppBundle\Form\Type;

use AppBundle\Form\Type\BookType;
use AppBundle\Entity\Book;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;


class BookTypeTest extends TypeTestCase
{
    private $em;

    protected function setUp()
    {
        // mock dependencies
        $this->em = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        parent::setUp();
    }

    protected function getExtensions()
    {
        // create booktype instance with mocked dependencies
        $bookType = new BookType($this->em);

        return array(
            new PreloadedExtension(array($bookType), array()),
        );
    }
    public function testSubmitValidData()
    {
        $formData = array(
            'title' => 'Test titel',
            'author' => 'der unit tester',
            'isbn' => '123445',
            'price' => '99',
        );

        // test that class BookType compiles
        $form = $this->factory->create(BookType::class);

        $book = new Book();
        $book->setTitle($formData['title'])
            ->setAuthor($formData['author'])
            ->setIsbn($formData['isbn'])
            ->setPrice($formData['price']);

        $form->submit($formData);

        // test that data is correctly transformed by the form
        $this->assertTrue($form->isSynchronized());

        // test that form was submitted and the data mapping is correct
        $this->assertEquals($book, $form->getData());

        // test that all widgets(eg keys from $formData)
        // are available in the children property
        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }


    }
}

