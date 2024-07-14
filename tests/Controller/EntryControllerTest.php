<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;

class EntryControllerTest extends WebTestCase
{
  /**
   * @throws Exception
   */
  public function test_it_can_create_a_new_entry(): void
  {
    $client = static::createClient();
    $container = static::getContainer();

    /** @var UserRepository $userRepository */
    $userRepository = $container->get(UserRepository::class);
    $testUser = $userRepository->findOneBy(['email' => 'testuser@example.com']);

    $cookie = new Cookie('user_token', $testUser->getToken());
    $client->getCookieJar()->set($cookie);

    $data = [
      'sensation' => 1,
      'feeling' => 1,
      'emotion' => 1,
      'need' => 1,
      'comment' => 'Test comment'
    ];



    $client->request(
      method: 'POST',
      uri: '/api/entry',
      parameters: $data
    );

    $this->assertNotEquals(
      Response::HTTP_UNAUTHORIZED,
      $client->getResponse()->getStatusCode(),
      'User is not authenticated'
    );

    $this->assertEquals(
      Response::HTTP_CREATED,
      $client->getResponse()->getStatusCode(),
      'Entry not created'
    );
  }
}