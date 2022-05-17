<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\QuestionReponse;
use App\Form\QuestionReponseType;
use App\Form\AdminQuestionReponseType;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;

use App\Repository\QuestionReponseRepository;

class AdminController extends AbstractController
{
    
    private $security;
    public function __construct(Security $security)
    {
        $this->security =$security;
    }
    /**
       * @Route("/admin", name="admin")
       * @return Response
       */
      public function index(ArticleRepository $articleRepository,PaginatorInterface $paginate,Request $request): Response
      {
        
          $articles = $paginate->paginate(
              $articleRepository->findAll(),
              $request->query->getInt('page', 1),
              15
          );
          return $this->render('admin/admin.html.twig', [
              'articles' => $articles
          ]);
      }


    /**
     * @Route("/admin/article/new", name="article_new")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $article =new Article();
        $form= $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $file = $form->get('brochureFilename')->getData();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'),$fileName);


            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
  
            $article->setBrochureFilename($fileName);

            $article->setCreateAt(new \DateTime());
            $article->setUser($this->security->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return  $this->redirectToRoute('article_new');
        }
        return $this->render('article/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    

    /**
     * @Route("/admin/article/{id}/edit", name="article_edit")
     */
    public function edit(Request $request, Article $article): Response
    {
        $form= $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return  $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }
        return $this->render('article/edit.html.twig', [
            'editForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/{id}/delete", name="article_delete")
     */
    public function delete(Article $article): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute(('admin'));
    }







    //question_reponse_administateur

     /**
     * @Route("/admin/questionreponse", name="question_reponse_admin")
     */

    public function indexQuestionReponse(QuestionReponseRepository $questionReponseRepository,PaginatorInterface $paginate,Request $request): Response
    {   $questionReponse = $paginate->paginate($questionReponseRepository->findAll(),
        $request->query->getInt('page',1),10);
        return $this->render('admin/adminqr.html.twig', [
            'questionReponses' => $questionReponse
        ]);
    }



    /**
     * @Route("/admin/questionreponse/new", name="admin_question_reponse_new")
     */
    public function newAdminQR(Request $request): Response
    {
        $questionReponse =new QuestionReponse();
        $form= $this->createForm(AdminQuestionReponseType::class, $questionReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionReponse->setCreatedAt(new \DateTime());
            $questionReponse->setUser($this->security->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($questionReponse);
            $entityManager->flush();
            return  $this->redirectToRoute("question_reponse_admin");
        }
        return $this->render('admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/admin/questionreponse/{id}/edit", name="admin_question_reponse_edit")
     */

   public function editAdminQR(Request $request,QuestionReponse $questionReponse ): Response
    {
        $form= $this->createForm(AdminQuestionReponseType::class, $questionReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($questionReponse);
            $entityManager->flush();
            return  $this->redirectToRoute("question_reponse_admin");
        }
        return $this->render('admin/edit.html.twig', [
            'editForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/questionreponse/{id}/delete", name="admin_question_reponse_delete")
     */
    public function deleteAdminQR(QuestionReponse $questionReponse): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($questionReponse);
        $em->flush();
        return $this->redirectToRoute(("question_reponse_admin"));
    }


}