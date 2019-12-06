<?php

class IndexTest extends TestCase
{
    public function testApplication()
    {
        $response = $this->call('GET', '/');

        $this->assertResponseOk($response->status());
    }
}
