<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 01.04.16
 * Time: 17:28
 */

namespace  Tests\AppBundle\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CheckAvailableRoutesTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return [
            ['/books'],
            ['/books/new'],
            ['/books/view/1'],
        ];
    }
}

