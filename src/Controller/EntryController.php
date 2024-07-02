<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Entity\User;
use App\Form\EntryType;
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
     * @param User $user
     * @return JsonResponse
     */
    #[Route('/entry', name: 'create_entry', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function createEntry(
        Request $request,
        FormService $formService,
        EntityManagerInterface $entityManager,
        #[CurrentUser] User $user
    ): JsonResponse
    {
        $entry = new Entry();
        $entry->setUser($user);

        $entryForm = $this
            ->createForm(EntryType::class, $entry)
            ->handleRequest($request);

        if (!$entryForm->isSubmitted() || !$entryForm->isValid()) {
            return $this->json([
                'errors' => $formService->getFormErrors($entryForm),
            ], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($entry);
        $entityManager->flush();

        return $this->json(['data' => $entry], Response::HTTP_CREATED);
    }
}
