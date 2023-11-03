<?php

namespace App\Controller;

use App\Repository\FeelingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FeelingController extends AbstractController
{

    #[Route('/api/feeling', name: 'app_feeling')]
    public function getFeelings(
        FeelingRepository $feelingRepository,
        SerializerInterface $serializer,
    ): JsonResponse
    {
        $feelings = $feelingRepository->findAll();
        $feelingsJson = $serializer->serialize($feelings, 'json');

        return new JsonResponse($feelingsJson, 200, [], true);
    }
}
