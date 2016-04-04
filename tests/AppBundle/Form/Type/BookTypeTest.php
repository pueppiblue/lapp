<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 04.04.16
 * Time: 17:35
 */

namespace Tests\AppBundle\Form\Type;

use Symfony\Component\Form\Tests\TestTypeCase;
use AppBundle\Form\Type\BookType;


class BookTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData= array(
            'test1' => 'test1',
            'test2' => 'test2',
        );

        $form = $this->factory->create(TestedType::class);

    }
}

