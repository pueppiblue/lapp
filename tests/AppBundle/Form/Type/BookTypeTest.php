<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 04.04.16
 * Time: 17:35
 */

namespace Tests\AppBundle\Form\Type;

use AppBundle\Form\Type\BookType;
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


        $form = $this->factory->create(BookType::class);

        //$form->submit($formData);

        $this->assertTrue($form->isSynchronized());

    }
}

