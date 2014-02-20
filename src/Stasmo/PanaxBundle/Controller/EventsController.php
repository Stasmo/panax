<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventsController extends Controller
{
    public function indexAction()
    {
    	$events = $this
    				->get('doctrine_mongodb')
			        ->getRepository('StasmoPanaxBundle:Event')
			        ->findBy([], [ 'date' => 'DESC' ]);
        return $this->render('StasmoPanaxBundle:Events:index.html.twig', [ 'events' => $events ]);
    }
}
