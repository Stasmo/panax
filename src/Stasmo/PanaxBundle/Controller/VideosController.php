<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VideosController extends Controller
{
    public function indexAction()
    {
        return $this->render('StasmoPanaxBundle:Videos:index.html.twig');
    }
}
