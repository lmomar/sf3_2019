<?php
/**
 * Created by PhpStorm.
 * User: olmounir
 * Date: 18/02/2019
 * Time: 16:35
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class TestClientController extends WebTestCase
{
    public function testIndexAction(){
        $client = static::createClient();
        $crawler = $client->getRequest('GET','/clients');
        //$this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertTrue(false);
    }

    public function testAddAction(){}

    public function testEditAction(){}

    public function testDeleteAction(){}

}