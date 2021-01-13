<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\EmailType;
use App\Service\EmailRenderer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request, EmailRenderer $emailRenderer, MailerInterface $mailer): Response
    {
        $emailForm = $this->createForm(EmailType::class)
            ->handleRequest($request)
        ;
        if ($emailForm->isSubmitted()) {
            $data = $emailForm->getData();
            $data = $emailRenderer->renderEmails($data['strategy'], $data['template']);

            foreach ($data as $row) {
                ['to' => $to, 'body' => $body] = $row;
                $email = (new Email())
                    ->from('no-reply@example.com')
                    ->to($to)
                    ->html($body)
                ;
                $mailer->send($email);
            }
        }

        return $this->render('home/index.html.twig', [
            'emailForm' => $emailForm->createView()
        ]);
    }
}
