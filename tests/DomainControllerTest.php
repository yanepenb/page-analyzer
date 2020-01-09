<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Domain;

class DomainControllerTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    private $domainsTestSet;

    public function setUp(): void
    {
        parent::setUp();

        $this->domainsTestSet = factory(Domain::class, 1)->create();
    }

    public function testDomainAnalysis()
    {
        $body = file_get_contents('tests/fixtures/test.html');
        $mock = new MockHandler([
            new Response(200, [], $body)
        ]);

        $handler = HandlerStack::create($mock);

        app()->bind('GuzzleHttp\Client', function ($app) use ($handler) {
            return new Client(['handler' => $handler]);
        });

        $this->post(route('domains.analysis'), ['domain' => 'https://test.com']);
        $this->seeInDatabase('domains', [
            'name' => 'https://test.com',
            'content_length' => strlen($body),
            'response_code' => 200,
            'body' => $body,
            'h1' => 'Test',
            'keywords' => 'test page analyzer',
            'description' => 'Test description'
        ]);
    }

    public function testDomainsIndex()
    {
        $this->seeInDatabase('domains', [
            'name' => $this->domainsTestSet->first()->name
        ]);

        $this->get(route('domains.index'))->assertResponseOk();
    }

    public function testDomainShow()
    {
        $this->get(route('domains.show', ['id' => $this->domainsTestSet->first()->id]));
        $this->assertResponseOk();
    }
}
