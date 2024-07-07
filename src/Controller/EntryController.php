<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Entity\User;
use App\Form\EntryType;
use App\Repository\EmotionRepository;
use App\Repository\FeelingRepository;
use App\Repository\NeedRepository;
use App\Repository\SensationRepository;
use App\Service\FormService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EntryController extends AbstractController
{
    /**
     * Create a new entry
     *
     * @param Request $request
     * @param FormService $formService
     * @param EntityManagerInterface $entityManager
     * @param SensationRepository $sensationRepository
     * @param EmotionRepository $emotionRepository
     * @param FeelingRepository $feelingRepository
     * @param NeedRepository $needRepository
     * @param User $user
     * @return JsonResponse
     */
    #[Route('api/entry', name: 'create_entry', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function createEntry(
        Request $request,
        FormService $formService,
        EntityManagerInterface $entityManager,
        SensationRepository $sensationRepository,
        EmotionRepository $emotionRepository,
        FeelingRepository $feelingRepository,
        NeedRepository $needRepository,
        #[CurrentUser] User $user
    ): JsonResponse
    {
        $entry = new Entry();

        $entryForm = $this
            ->createForm(EntryType::class)
            ->handleRequest($request);

        if (!$entryForm->isSubmitted() || !$entryForm->isValid()) {
            return $this->json([
                'errors' => $formService->getFormErrors($entryForm),
            ], Response::HTTP_BAD_REQUEST);
        }

        $entryData = $entryForm->getData();

        $sensation = $sensationRepository->findOneBy(['id' => $entryData['sensation']]);
        $feeling = $feelingRepository->findOneBy(['id' => $entryData['feeling']]);
        $emotion = $emotionRepository->findOneBy(['id' => $entryData['emotion']]);
        if($entryData['need']) {
            $need = $needRepository->findOneBy(['id' => $entryData['need']]);
        } else {
            $need = null;
        }

        $entry
          ->setUser($user)
          ->setSensation($sensation)
          ->setEmotion($emotion)
          ->setFeeling($feeling)
          ->setNeed($need)
          ->setComment($entryData['comment']);

        $entityManager->persist($entry);
        $entityManager->flush();

        return $this->json(null, Response::HTTP_CREATED);
    }

    /**
     * Get all entries for current User
     *
     * @param User $user
     * @return JsonResponse
     */
    #[Route('api/entry', name: 'user_entries')]
    #[IsGranted('ROLE_USER')]
    public function getUserEntries(
        #[CurrentUser] User $user
    ): JsonResponse
    {
        $entries = $user->getEntries();

        return $this->json(
            data: ['data' => $entries],
            status: Response::HTTP_OK,
            context: ['groups' => ['Public', 'Private']]
        );
    }
}
