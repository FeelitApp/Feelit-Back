<?php

namespace App\Controller;

use App\Entity\Results;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultsController extends AbstractController
{
    #[Route('/api/results', name: 'app_results', methods: 'POST')]
    public function new (ManagerRegistry $doctrine, Request $request
    ): JsonResponse {
        $entityManager = $doctrine->getManager();

        $results = new Results();

        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);


        $results->setDate($request->request->get('date'));
        $results->setSensationId($request->request->get('sensationId'));
        $results->setFeelingId($request->request->get('feelingId'));
        $results->setEmotionId($request->request->get('emotionId'));
        $results->setNote($request->request->get('note'));

        $entityManager->persist($results);
        $entityManager->flush();

        return $this->json('Created new result successfully with id ' . $results->getId());
    }
}
