<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Commentaire;
use App\Entity\Article;
use App\Entity\Comment;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    //	for ($i=0;$i<=5; $i++)
    //	{
    		//$Commentaire= new Commentaire();
    		//$Commentaire->setTexte("commentaire1")
    		//->setCreatedAt(new \DateTime());
    		//$manager->persist($Commentaire);
/*$faker = Factory::create('ar_JO');
    		for ($j=0;$j<=2; $j++)
    		{
    			$article= new Article();
    			$article->setTitle("titre")
    					->setTexte("HTML 5 va devenir la nouvelle norme pour HTML, XHTML et le DOM HTML. HTML 5 est le fruit d'un travail collaboratif entre WHATWG et le W3C qui à débuté en 2004. Il est à noter que le projet HTML 5 est encore en cours de réalisation bien que certains navigateurs commencent à le supporter en partie. Que va apporter HTML 5")
    					->setCreateAt(new \DateTime());
    				//	->setCommentaires($Commentaire);
    					$manager->persist($article);
			for ($k=0; $k<=mt_rand(4,6); $k++)
			{
				$comment = new  Comment();
				$comment->setContent('la nouvelle norme pour HTML, XHTML et le DOM')
						->setcreatedAt(new \DateTime())
						->setArticle($article);
						$manager->persist($comment);
			}

    		}
//}

        $manager->flush();*/
    }
}
