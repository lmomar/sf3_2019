<?php
namespace AppBundle\Service;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class AvatarService
{

    public function getAvatar($fullName){
        $client = new Client(['base_uri' => 'https://ui-avatars.com/']);
        $response = $client->request('get','api/?name=Elon+Musk');

        dump($response->getBody());die('request');
    }
}