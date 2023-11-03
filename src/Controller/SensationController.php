<?php

namespace App\Controller;

use App\Repository\SensationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SensationController extends AbstractController
{
    #[Route('/api/sensation', name: 'app_sensation')]
    public function getSensation(
        SensationRepository $sensationRepository,
        SerializerInterface $serializer,
    ): JsonResponse
    {
        $sensations = $sensationRepository->findAll();
        $sensationsJson = $serializer->serialize($sensations, 'json');

        return new JsonResponse($sensationsJson, 200, [], true);
    }
}
