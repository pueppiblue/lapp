<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 06.04.16
 * Time: 19:28
 */

namespace tests\AppBundle\Entity;

use AppBundle\Entity\Book;

class BookTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array @bookData
     * @dataProvider providerBookData
     */
    public function testGetBookReturnsExpectedBookObject($bookData)
    {
        $book = new Book();

        $book->setTitle($bookData['title'])
            ->setAuthor($bookData['author'])
            ->setIsbn($bookData['isbn'])
            ->setPrice($bookData['price']);

        assertEquals($book->getTitle(),$bookData['title']);
        assertEquals($book->getAuthor(),$bookData['author']);
        assertEquals($book->getISBN(),$bookData['isbn']);
        assertEquals($book->getPrice(),$bookData['price']);

    }

    /**
     * @return array testData for Book
     */
    public function providerBookData()
    {
        return array(
            'String Data' => array(
                    'title' => 'TestBook1',
                    'author' => 'Testerman',
                    'isbn' => '12345',
                    'price' => '9,99',
            ),
            'empty fields' => array(
                    'title' => '',
                    'author' => '',
                    'isbn' => '',
                    'price' => '',
            ),
        );
    }
}
