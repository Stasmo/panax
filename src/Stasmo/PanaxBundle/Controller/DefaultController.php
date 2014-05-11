<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $posts = $this
            ->get('doctrine')
            ->getRepository('StasmoPanaxBundle:Post')->createQueryBuilder('p')
            ->where('p.date <= :date')
            ->andWhere('p.display = true')
            ->setParameters(array('date' => new \DateTime()))
            ->orderBy('p.date', 'desc')
            ->getQuery()
            ->execute()
        ;

		$music = $this
			->get('doctrine')
	        ->getRepository('StasmoPanaxBundle:Music')
	        ->findBy(['displayOnHome' => true], ['displayOrder' => 'asc']);

        return 
        	$this->render('StasmoPanaxBundle:Default:index.html.twig',
        		['posts' => $posts, 'music' => $music]
        	)
       	;
    }
}
