<?php

namespace App\Controller;

use App\Repository\EmotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EmotionController extends AbstractController
{
    #[Route('/emotion', name: 'app_emotion')]
    public function index(
        EmotionRepository $emotionRepository
    ): JsonResponse
    {
        $emotions = $emotionRepository->findAll();
        var_dump($emotions);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EmotionController.php',
        ]);
    }
}
