<?php
namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class TokenAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly UserRepository $userRepository,
    )
    {}

    public function supports(Request $request): bool
    {
        return $request->cookies->has('user_token');
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        $token = $request->cookies->get('user_token');

        if (empty($token)) {
            throw new CustomUserMessageAuthenticationException('No token found');
        }

        $userBadge = new UserBadge($token, function (String $token) {
            return $this->userRepository->findOneBy(['token' => $token]);
        });

        return new SelfValidatingPassport($userBadge);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
      $cookies = Cookie::create('user_token')
        ->withExpires(strtotime('-1'))
        ->withSecure($_ENV['APP_ENV'] === 'prod');

      $response = new JsonResponse([
          'code' => 'AUTHENTICATION_FAILED',
      ], Response::HTTP_UNAUTHORIZED);
      $response->headers->setCookie($cookies);
      return $response;
    }
}
