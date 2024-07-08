<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class EmotionControllerTest extends WebTestCase
{
    public function test_it_can_get_emotions(): void
    {
        //we mock a client get request
        $client = static::createClient();
        $client->request('GET', '/api/emotion');

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

        foreach ($responseData as $emotion) {
            $this->assertArrayHasKey('id', $emotion);
            $this->assertArrayHasKey('feeling', $emotion);
            $this->assertArrayHasKey('content', $emotion);

            $this->assertIsInt($emotion['id']);
            $this->assertIsString($emotion['content']);
            $this->assertIsArray($emotion['feeling']);

            $this->assertArrayHasKey('id', $emotion['feeling']);
            $this->assertArrayHasKey('category', $emotion['feeling']);
            $this->assertArrayHasKey('emoji', $emotion['feeling']);

            $this->assertIsInt($emotion['feeling']['id']);
            $this->assertIsString($emotion['feeling']['category']);
            $this->assertIsString($emotion['feeling']['emoji']);
        }
    }
}