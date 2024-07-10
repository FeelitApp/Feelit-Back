<?php

namespace App\Controller;

use App\Service\MailerSendService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
  private MailerSendService $mailerSendService;

  public function __construct(MailerSendService $mailerSendService)
  {
    $this->mailerSendService = $mailerSendService;
  }
  #[Route('/contact', name: 'contact', methods: ['POST'])]
  public function sendEmail(Request $request): Response
  {
    $data = json_decode($request->getContent(), true);

    $name = $data['name'];
    $email = $data['email'];
    $object = $data['object'];
    $message = $data['message'];

    $this->mailerSendService->sendEmail($name, $email, $object, $message);

    return $this->json(['message' => 'Email sent'], Response::HTTP_CREATED);
  }
}
