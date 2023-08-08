<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendWelcomeEmail extends AbstractController{
	private $mailer;
	public function __construct(MailerInterface $mailer)
	{
		 $this->mailer = $mailer;
	}
	public function sendEmailToRegisteredUser(array $array):void{
		$password = $array['password'];
		$data = $array['user'];
      $newEmail = (new TemplatedEmail())
          ->from($this->getParameter('app.mailer_address'))
          ->to($data->getEmail())
          ->subject("Potwierdzono logowanie")
          ->htmlTemplate('emails/confirm.html.twig')
          ->context([
											'data' => $data,
											'password' => $password,
          ]);

		$this->mailer->send($newEmail);
	}
}