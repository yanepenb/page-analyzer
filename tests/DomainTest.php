<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

class DomainTest extends TestCase
{
    public function testAddDomain()
    {
        $body = file_get_contents('tests/fixtures/test.html');
        $mock = new MockHandler([
            new Response(200, [], $body)
        ]);

        $handler = HandlerStack::create($mock);

        app()->bind('GuzzleHttp\Client', function ($app) use ($handler) {
            return new Client(['handler' => $handler]);
        });

        $this->post('/domains', ['domain' => 'https://test.com']);
        $this->seeInDatabase('domains', [
            'name' => 'https://test.com',
            //'content_length' => strlen($body),
            'response_code' => 200,
            'body' => $body,
            'h1' => 'Test',
            'keywords' => 'test page analyzer',
            'description'=> 'Test description'
        ]);
    }

    public function testDomainList()
    {
        $response = $this->call('GET', '/domains');

        $this->assertResponseOk($response->status());
    }
}
