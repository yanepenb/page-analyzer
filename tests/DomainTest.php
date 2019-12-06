<?php

class DomainTest extends TestCase
{
    public function testAddUrl()
    {
        $this->call('POST', '/domains', ['url' => 'https://laravel.com/']);

        $this->seeInDatabase('domains', [
            'name' => 'https://laravel.com/'
        ]);
    }
}
