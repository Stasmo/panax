<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BiographyController extends Controller
{
    public function indexAction()
    {
        return $this->render('StasmoPanaxBundle:Biography:index.html.twig');
    }
}
