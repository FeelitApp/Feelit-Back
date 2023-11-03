<?php

namespace App\Controller;

use App\Repository\EmotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EmotionController extends AbstractController
{
    #[Route('/api/emotion', name: 'app_emotion')]
    public function getEmotion(
        EmotionRepository $emotionRepository,
        SerializerInterface $serializer,
    ): JsonResponse
    {
        $emotions = $emotionRepository->findAll();
        $emotionsJson = $serializer->serialize($emotions, 'json');

        return new JsonResponse($emotionsJson, 200, [], true);
    }
}
