<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 27.11.15
 * Time: 15:20
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BookControllerTest extends WebTestCase
{
    public function testListBooks()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/books');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welt des Häkelns', $client->getResponse()->getContent());
    }
}
