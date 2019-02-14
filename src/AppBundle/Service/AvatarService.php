<?php
namespace AppBundle\Service;


use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class AvatarService
{

    public function getAvatar($fullName){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('get','https://ui-avatars.com/api/?name=Elon+Musk');

        dump($response->getBody());die('request');
    }
}