<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\QuestionReponse;
use App\Form\QuestionReponseType;
use App\Repository\QuestionReponseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class QuestionReponseController extends AbstractController

{
    private $security;
    public function __construct(Security $security)
    {
        $this->security =$security;
    }
    /**
     * @Route("/questionreponse", name="question_reponse")
     */

    public function index(QuestionReponseRepository $questionReponseRepository,PaginatorInterface $paginate,Request $request): Response
    {   $questionReponse = $paginate->paginate($questionReponseRepository->findAll(),
        $request->query->getInt('page',1),10);
        return $this->render('question_reponse/index.html.twig', [
            'questionReponses' => $questionReponse
        ]);
    }

    /**
     * @Route("/user/questionreponse/new", name="question_reponse_new")
     */
    public function new(Request $request): Response
    {
        $questionReponse =new QuestionReponse();
        $form= $this->createForm(QuestionReponseType::class, $questionReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionReponse->setCreatedAt(new \DateTime());
            $questionReponse->setUser($this->security->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($questionReponse);
            $entityManager->flush();
            return  $this->redirectToRoute("question_reponse");
        }
        return $this->render('question_reponse/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/user/uestionreponse/{id}/edit", name="question_reponse_edit")
     */

   public function edit(Request $request,QuestionReponse $questionReponse ): Response
    {
        $form= $this->createForm(QuestionReponseType::class, $questionReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($questionReponse);
            $entityManager->flush();
            return  $this->redirectToRoute("question_reponse");
        }
        return $this->render('question_reponse/edit.html.twig', [
            'editForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/questionreponse/{id}/delete", name="question_reponse_delete")
     */
    public function delete(QuestionReponse $questionReponse): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($questionReponse);
        $em->flush();
        return $this->redirectToRoute(("question_reponse"));
    }
}
