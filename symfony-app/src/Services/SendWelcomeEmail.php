<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendWelcomeEmail extends AbstractController{
	private $mailer;
	public function __construct(MailerInterface $mailer)
	{
		 $this->mailer = $mailer;
	}
	public function sendEmailToRegisteredUser(User $user):void{
		$data = $user;
      $newEmail = (new TemplatedEmail())
          ->from($this->getParameter('app.mailer_address'))
          ->to($data->getEmail())
          ->subject("Potwierdzono logowanie")
          ->htmlTemplate('emails/confirm.html.twig')
          ->context([
              'data' => $data,
          ]);

		$this->mailer->send($newEmail);
	}
}