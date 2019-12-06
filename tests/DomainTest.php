<?php


class DomainTest extends TestCase
{
    public function testAddDomain()
    {
        $this->call('POST', '/domains', ['domain' => 'https://travis-ci.org/']);

        $this->seeInDatabase('domains', [
            'name' => 'https://travis-ci.org/'
        ]);
    }
}
