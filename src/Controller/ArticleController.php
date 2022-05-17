<?php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{       
    private $security;
    public function __construct(Security $security)
    {
        $this->security =$security;
    }
    /**
     * @Route("/article/conventions", name="article_conventions")
     */
    public function indexconventions(ArticleRepository $articleRepository,PaginatorInterface $paginate,Request $request): Response
    {   $articles = $paginate->paginate($articleRepository->findBy(array('loi' => 'convention'),),
        $request->query->getInt('page',1),10);
        return $this->render('article/conventions.html.twig', [
            'articles' => $articles
        ]);
    }

     /**
     * @Route("/article/codes", name="article_codes")
     */
    public function indexcodes(ArticleRepository $articleRepository,PaginatorInterface $paginate,Request $request): Response
    {   $articles = $paginate->paginate($articleRepository->findBy(array('loi' => 'codes'),),
        $request->query->getInt('page',1),10);
        return $this->render('article/codes.html.twig', [
            'articles' => $articles
        ]);
    }

     /**
     * @Route("/article/loisetdecrets", name="article_loisetdecrets")
     */
    public function indexloisetdecrets(ArticleRepository $articleRepository,PaginatorInterface $paginate,Request $request): Response
    {   $articles = $paginate->paginate($articleRepository->findBy(array('loi' => 'lois et décrets'),),
        $request->query->getInt('page',1),10);
        return $this->render('article/loisetdecrets.html.twig', [
            'articles' => $articles
        ]);
    }

     /**
     * @Route("/article/actualites", name="article_actualites")
     */
    public function indexactualites(ArticleRepository $articleRepository,PaginatorInterface $paginate,Request $request): Response
    {   $articles = $paginate->paginate($articleRepository->findBy(array('loi' => 'actualités'),),
        $request->query->getInt('page',1),10);
        return $this->render('article/actualites.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(Article $article,Request $request): Response
    {   $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setCreatedAt(new \DateTime());
            $comment->setArticle($article);
            $comment->setUser($this->security->getUser());
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute("article_show", ['id'=>$article->getId()]);
        }
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("user/article/{id1}/comment/{id}/edit", name="comment_edit")
     */
    public function edit(Request $request, $id1,$id): Response
    {   $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        $article= $this->getDoctrine()->getRepository(Article::class)->find($id1);
        $form= $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute("article_show", ['id'=>$article->getId()]);
        }
        return $this->render('article/editcomment.html.twig', [
            'editForm' => $form->createView()
        ]);
    }

    /**
     * @Route("user/article/{id1}/comment/{id}/delete", name="comment_delete")
     */
    public function delete($id1,$id): Response
    {   $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        $article= $this->getDoctrine()->getRepository(Article::class)->find($id1);
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        return $this->redirectToRoute("article_show", ['id'=> $article->getId()] );
    }
    

}
