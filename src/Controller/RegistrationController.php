<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {   $user = new User();
        
        $form = $this->createForm(RegistationType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {   $user->setPassword($passwordEncoder->encodePassword($user,$form->get('password')->getData()));
            $user->setRoles(['ROLE_USER']);
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/index.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }
}
