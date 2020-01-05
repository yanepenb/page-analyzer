<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

class HomePageControllerTest extends \Tests\TestCase
{
    public function testIndex()
    {
        $this->get(route('home.index'))->assertResponseOk();
    }
}
