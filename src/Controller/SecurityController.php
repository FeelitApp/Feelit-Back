<?php

namespace App\Controller;

use App\Form\LoginFormType;
use App\Form\RegistrationFormType;
use App\Entity\User;
use App\Form\UserPasswordUpdateType;
use App\Repository\UserRepository;
use App\Service\FormService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Form\UserInfoUpdateType;


/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * Register a user
     *
     * @param Request $request
     * @param FormService $formService
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(
        Request $request,
        FormService $formService,
        UserPasswordHasherInterface $passwordEncoder,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $user = new User();

        $registerForm = $this
            ->createForm(RegistrationFormType::class, $user)
            ->handleRequest($request);

        if(!$registerForm->isSubmitted() || !$registerForm->isValid()) {
            return $this->json([
                'errors' => $formService->getFormErrors($registerForm),
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->setPassword($passwordEncoder->hashPassword($user, $user->getPassword()));

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Login a user and send an auto generate token
     *
     * @param Request $request
     * @param FormService $formService
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('api/login', name: 'login', methods: ['POST'])]
    public function login(
        Request $request,
        FormService $formService,
        UserPasswordHasherInterface $passwordEncoder,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {

        $loginForm = $this
            ->createForm(LoginFormType::class)
            ->handleRequest($request);

        if(!$loginForm->isSubmitted() || !$loginForm->isValid()) {
            return $this->json([
                'errors' => $formService->getFormErrors($loginForm),
            ], Response::HTTP_BAD_REQUEST);
        }

        $loginData = $loginForm->getData();
        $user = $userRepository->findOneBy(['email' => $loginData['email']]);

        if (!$user || !$passwordEncoder->isPasswordValid($user, $loginData['password'])) {
            return $this->json(['code' => 'PASSWORD_INVALID'], Response::HTTP_BAD_REQUEST);
        }

        $token = bin2hex(openssl_random_pseudo_bytes(15));
        $user->setToken($token);
        $entityManager->flush();

        $cookies = Cookie::create('user_token')
          ->withValue($token)
          ->withExpires(strtotime('+1 week'))
          ->withDomain($_ENV['COOKIE_DOMAIN'])
          ->withSecure($_ENV['APP_ENV'] === 'prod');

        return $this->json(
            data: ['data' => $user],
            status: Response::HTTP_OK,
            headers: ['Set-Cookie' => $cookies],
            context: ['groups' => ['Public', 'Private']]
        );
    }

  #[Route('api/logout', name: 'auth_logout', methods: ['POST'])]
  #[IsGranted('ROLE_USER')]
  public function logout(
    #[CurrentUser] $user,
    EntityManagerInterface             $entityManager,
  ): JsonResponse
  {
    $user->setToken(null);
    $entityManager->flush();

    $cookies = Cookie::create('user_token')
      ->withExpires(strtotime('-1'))
      ->withDomain($_ENV['COOKIE_DOMAIN'])
      ->withSecure($_ENV['APP_ENV'] === 'prod');

    return $this->json(
      data: null,
      status: Response::HTTP_NO_CONTENT,
      headers: ['Set-Cookie' => $cookies]
    );
  }

    #[Route('api/me', name: 'me', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function me(
        #[CurrentUser] User $user
    ): JsonResponse
    {
        return $this->json(
            data: ['data' => $user],
            status: Response::HTTP_OK,
            context: ['groups' => ['Public', 'Private']]
        );
    }

  #[Route('api/users/me', name: 'account_update_infos', methods: ['POST'])]
  #[IsGranted('ROLE_USER')]
  public function updateInfos(
    #[CurrentUser] $user,
    Request                            $request,
    FormService                        $formService,
    EntityManagerInterface             $entityManager,
  ): JsonResponse
  {
    $userInfoForm = $this
      ->createForm(UserInfoUpdateType::class, $user)
      ->handleRequest($request);

    if (!$userInfoForm->isSubmitted() || !$userInfoForm->isValid()) {
      return $this->json([
        'errors' => $formService->getFormErrors($userInfoForm),
      ], Response::HTTP_BAD_REQUEST);
    }

    $entityManager->flush();

    return $this->json(
      data: ['data' => $user],
      status: Response::HTTP_OK,
      context: ['groups' => ['Private', 'Public']],
    );
  }


  #[Route('api/users/me/password', name: 'account_update_password', methods: ['POST'])]
  #[IsGranted('ROLE_USER')]
  public function updatePassword (
    #[CurrentUser] User $user,
    Request                            $request,
    FormService                        $formService,
    EntityManagerInterface             $entityManager,
    UserPasswordHasherInterface        $passwordEncoder,
  ): JsonResponse
  {
    $userPasswordForm = $this
        ->createForm(UserPasswordUpdateType::class)
        ->handleRequest($request);

    if (!$userPasswordForm->isSubmitted() || !$userPasswordForm->isValid()) {
        return $this->json([
            'errors' => $formService->getFormErrors($userPasswordForm),
        ], Response::HTTP_BAD_REQUEST);
    }

    $passwordData = $userPasswordForm->getData();
    if (!$passwordEncoder->isPasswordValid($user, $passwordData['currentPassword'])) {
      return $this->json(['errors' => ['currentPassword' => ['Votre mot de passe est invalide']]], Response::HTTP_BAD_REQUEST);
    }

    $encodedPassword = $passwordEncoder->hashPassword($user, $passwordData['newPassword']);
    $user->setPassword($encodedPassword);

    $entityManager->flush();

    return $this->json(null, Response::HTTP_NO_CONTENT);
  }

  #[Route('api/me/delete', name: 'account_delete', methods: ['DELETE'])]
  #[IsGranted('ROLE_USER')]
  public function delete(
    #[CurrentUser] $user,
    EntityManagerInterface             $entityManager,
  ): JsonResponse
  {
    $entityManager->remove($user);
    $entityManager->flush();

    $cookies = Cookie::create('user_token')
      ->withValue('')
      ->withExpires(-1)
      ->withSecure(false);

    return $this->json(
      data: null,
      status: Response::HTTP_NO_CONTENT,
      headers: ['Set-Cookie' => $cookies]
    );
  }
}