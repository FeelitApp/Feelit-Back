<?php
namespace App\Service;

use MailerSend\Exceptions\MailerSendException;
use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\Sender;

class MailerSendService
{
  private MailerSend $mailerSend;

  /**
   * @throws MailerSendException
   */
  public function __construct()
  {
    $this->mailerSend = new MailerSend([
      'api_key' => $_ENV['MAILERSEND_API_KEY'],
    ]);
  }

  public function sendEmail($senderName, $senderEmail, $object, $message): void
  {
    $sentFrom = new Sender("postmaster@feelit-app.com", "Feelit Website");

    $recipients = [
      new Recipient("feelit.ada@gmail.com", "Feelit")
    ];

    $formattedHtmlMessage = "
            <p><strong>Nom:</strong> $senderName</p>
            <p><strong>Email:</strong> $senderEmail</p>
            <p><strong>Objet:</strong> $object</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";

    $formattedTextMessage = "
            Nom: $senderName
            Email: $senderEmail
            Objet: $object
            Message:
            $message
        ";

    $emailParams = (new EmailParams())
      ->setFrom($sentFrom)
      ->setTo($recipients)
      ->setReplyTo($sentFrom)
      ->setSubject("Demande de contact")
      ->setHtml($formattedHtmlMessage)
      ->setText($formattedTextMessage);

    $this->mailerSend->email->send($emailParams);
  }
}
