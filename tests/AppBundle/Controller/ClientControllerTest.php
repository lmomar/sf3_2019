<?php

namespace Tests\AppBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{
    public function testIndexAction(){
        $client = static::createClient();
        $client->request('GET','/clients');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testAddAction(){
        $this->fail('msg failure');
    }



}