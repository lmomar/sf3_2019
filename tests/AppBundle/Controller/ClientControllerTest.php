<?php
/**
 * Created by PhpStorm.
 * User: olmounir
 * Date: 18/02/2019
 * Time: 16:35
 */

namespace Tests\AppBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{

    public function testIndexAction(){
        $client = static::createClient();
        $crawler = $client->request('GET','/clients');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testAddAction(){
        $client = static::createClient();
        $crawler = $client->request('POST','/clients/add');
        $form = $crawler->selectButton('client_submit')->form();
        $form['client[sexe]']='Male';
        $form['client[firstname]']='first name';
        $form['client[lastname]']='last name';
        $form['client[tel]']='0600000000';
        $form['client[email]']='test11@gmail.com';
        $form['client[adresse]']='rabat 001';

        $crawler =$client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/clients'));
    }


    public function testDeleteAction(){
        $client = static::createClient();
        $crawler = $client->request('GET','/clients/delete/8');
        $form = $crawler->selectButton('form_confirm')->form();
        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/clients'));
    }

}