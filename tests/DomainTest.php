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
}
