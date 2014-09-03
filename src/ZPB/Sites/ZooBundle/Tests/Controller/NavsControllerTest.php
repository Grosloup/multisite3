<?php

namespace ZPB\Sites\ZooBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NavsControllerTest extends WebTestCase
{
    public function testTopnav()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/topnav');
    }

}
