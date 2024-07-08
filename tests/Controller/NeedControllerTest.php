<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class NeedControllerTest extends WebTestCase
{
    public function test_it_can_get_needs(): void
    {
        //we mock a client get request
        $client = static::createClient();
        $client->request('GET', '/api/need');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        //once we have an OK response, we make sure it's a json format
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        //we decode it, and we check if it's the right keys + right types
        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertIsArray($responseData);

        foreach ($responseData as $need) {
            $this->assertArrayHasKey('id', $need);
            $this->assertArrayHasKey('content', $need);
            $this->assertArrayHasKey('picture', $need);

            $this->assertIsInt($need['id']);
            $this->assertIsString($need['content']);
            $this->assertIsString($need['picture']);
        }
    }
}