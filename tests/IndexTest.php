<?php

use Illuminate\Http\Response;

class IndexTest extends TestCase
{
    public function testApplication()
    {
        $response = $this->call('GET', '/');

        $this->assertResponseOk(200, $response->status());
    }
}
