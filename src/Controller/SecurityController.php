<?php

namespace App\Controller;

use App\Form\LoginFormType;
use App\Form\RegistrationFormType;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\FormService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(
        Request $request,
        FormService $formService,
        UserPasswordHasherInterface $passwordEncoder,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $user = new User();

        $loginForm = $this
            ->createForm(LoginFormType::class, $user)
            ->handleRequest($request);

        if(!$loginForm->isSubmitted() || !$loginForm->isValid()) {
            return $this->json([
                'errors' => $formService->getFormErrors($loginForm),
            ], Response::HTTP_BAD_REQUEST);
        }

        $loginData = $loginForm->getData();
        $user = $userRepository->findOneBy(['email' => $loginData->getEmail()]);

        if (!$user || !$passwordEncoder->isPasswordValid($user, $loginData->getPassword())) {
            return $this->json(['code' => 'PASSWORD_INVALID'], Response::HTTP_BAD_REQUEST);
        }

        $user->setToken(bin2hex(openssl_random_pseudo_bytes(15)));
        $entityManager->flush();

        return $this->json(
            data: ['data' => $user],
            status: Response::HTTP_OK,
            context: ['groups' => ['Public', 'Private']]
        );
    }

    #[Route('/me', name: 'me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        return $this->json(
            data: ['data' => $this->getUser()],
            status: Response::HTTP_OK,
            context: ['groups' => ['Public', 'Private']]
        );
    }
}