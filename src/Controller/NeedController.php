<?php

namespace App\Controller;

use App\Repository\NeedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class NeedController extends AbstractController
{
    #[Route('/api/need', name: 'app_need')]
    public function getNeeds(
        NeedRepository $needRepository,
        SerializerInterface $serializer,
    ): JsonResponse
    {
        $needs = $needRepository->findAll();
        $needsJson = $serializer->serialize($needs, 'json');

        return new JsonResponse($needsJson, 200, [], true);
    }
}
