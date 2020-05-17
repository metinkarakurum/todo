<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class ServiceTest extends TestCase{

    public function testServiceItTask(){
        $client     = HttpClient::create();
        $response   = $client->request('GET', 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        $this->assertEquals($response->getStatusCode(),200);
    }

    public function testServiceBusinessTask(){
        $client     = HttpClient::create();
        $response   = $client->request('GET', 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7');
        $this->assertEquals($response->getStatusCode(),200);
    }
}