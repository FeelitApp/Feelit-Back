<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FeelingControllerTest extends WebTestCase
{
    public function test_it_can_get_feelings(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/feeling');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        //once we have an OK response, we make sure it's a json format
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        //we decode it, and we check if it's the right keys
        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertIsArray($responseData);

        foreach ($responseData as $feeling) {
            $this->assertArrayHasKey('id', $feeling);
            $this->assertArrayHasKey('category', $feeling);
            $this->assertArrayHasKey('emoji', $feeling);

            $this->assertIsInt($feeling['id']);
            $this->assertIsString($feeling['category']);
            $this->assertIsString($feeling['emoji']);
        }
    }
}