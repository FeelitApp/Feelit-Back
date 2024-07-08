<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SensationControllerTest extends WebTestCase
{
    public function test_it_can_get_sensations(): void
    {
        //we mock a client get request
        $client = static::createClient();
        $client->request('GET', '/api/sensation');

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

        foreach ($responseData as $sensation) {
            $this->assertArrayHasKey('id', $sensation);
            $this->assertArrayHasKey('feeling', $sensation);
            $this->assertArrayHasKey('content', $sensation);

            $this->assertIsInt($sensation['id']);
            $this->assertIsString($sensation['content']);
            $this->assertIsArray($sensation['feeling']);

            $this->assertArrayHasKey('id', $sensation['feeling']);
            $this->assertArrayHasKey('category', $sensation['feeling']);
            $this->assertArrayHasKey('emoji', $sensation['feeling']);

            $this->assertIsInt($sensation['feeling']['id']);
            $this->assertIsString($sensation['feeling']['category']);
            $this->assertIsString($sensation['feeling']['emoji']);
        }
    }
}