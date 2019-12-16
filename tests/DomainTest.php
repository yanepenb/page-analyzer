<?php

use GuzzleHttp\Client;
use Illuminate\Container\Container;

class DomainTest extends TestCase
{
    public function testAddDomain()
    {
        $this->call('POST', '/domains', ['domain' => 'https://travis-ci.org/']);

        $this->seeInDatabase('domains', [
            'name' => 'https://travis-ci.org/'
        ]);
    }

    public function testDomainList()
    {
        $response = $this->call('GET', '/domains');

        $this->assertResponseOk($response->status());
    }

    // public function testDomainMock()
    // {
    //     $content = file_get_contents('tests/fixtures/test.html')
    //     $mock = new MockHandler([
    //         new Response(200, ['Content-Length' => 0]),
    //     ]);
        
    //     $handlerStack в= HandlerStack::create($mock);
    //     $client = new Client(['handler' => $handlerStack]);
        
    //     // The first request is intercepted with the first response.
    //     $response = $client->request('GET', '/');
    //     echo $response->getStatusCode();
    //     //> 200
    //     echo $response->getBody();
    //     //> Hello, World
    //     // The second request is intercepted with the second response.
    //     echo $client->request('GET', '/')->getStatusCode();
    //     //> 202
        
    //     // Reset the queue and queue up a new response
    //     $mock->reset();
    //     $mock->append(new Response(201));
        
    //     // As the mock was reset, the new response is the 201 CREATED,
    //     // instead of the previously queued RequestException
    //     echo $client->request('GET', '/')->getStatusCode();
    //     //> 201




    //     $response = $this->call('GET', '/domains');
    //     $container = Container::getInstance();
    //     $client = $container->make('GuzzleHttp\Client');
    //     $this->assertResponseOk($response->status());
    // }
}
