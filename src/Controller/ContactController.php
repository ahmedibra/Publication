<?php  
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\ContactType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class ContactController extends AbstractController
{	/**
  * @Route("/contact", name="contact")
  * 
  */
	public function contact(Request $request, MailerInterface $mailer)
	{
      $form = $this->createForm(ContactType::class);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $contactFormData = $form->getData();
         $email = (new Email())
            ->from($contactFormData['email'])
            ->to('elibrahimihmed@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($contactFormData['sujet'])
            ->text( 'Time for Symfony Mailer!')
            ->html($contactFormData['message'].'<br><br>'.$contactFormData['nom'].'<br>'.$contactFormData['telephone'].'<br>'. $contactFormData['email']);

        /** @var Symfony\Component\Mailer\SentMessage $sentEmail */
        $sentEmail = $mailer->send($email);

      }
        return $this->render('pages/contact.html.twig', [
            'our_form' => $form->createView(),
        ]);
       }
}