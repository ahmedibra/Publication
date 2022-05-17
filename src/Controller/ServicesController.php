<?php  
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class ServicesController extends AbstractController
{	
       /**
       * @Route("/services", name="services")
       * @return Response
       */
	public function index():Response
	{
        return $this->render('pages/services.html.twig');
       }
}