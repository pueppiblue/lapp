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
     * @param string $title
     * @param string $author
     * @param string $isbn
     * @param string $price
     * @dataProvider providerBookData
     */
    public function testGetBookReturnsExpectedBookObject($title, $author, $isbn, $price)
    {
        $book = new Book();
        $book->setTitle($title)
            ->setAuthor($author)
            ->setIsbn($isbn)
            ->setPrice($price);

        $this->assertEquals($book->getTitle(), $title);
        $this->assertEquals($book->getAuthor(), $author);
        $this->assertEquals($book->getISBN(), $isbn);
        $this->assertEquals($book->getPrice(), $price);

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
