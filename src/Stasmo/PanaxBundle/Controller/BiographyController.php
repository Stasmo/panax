<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Stasmo\PanaxBundle\Entity\Biography;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/bio")
 */
class BiographyController extends Controller
{

    public function indexAction()
    {
        $bio = $this
            ->get('doctrine')
            ->getRepository('StasmoPanaxBundle:Biography')
            ->findOneBy([]);
        return $this->render('StasmoPanaxBundle:Biography:index.html.twig', ['bio' => $bio]);
    }


    /**
     * @Route("/edit", name="edit_bio")
     */
    public function editAction(Request $request)
    {
        $bio = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Biography')
                ->findOneBy([]);
    	$form = $this->getBioForm($bio);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $dm = $this->get('doctrine')->getManager();
                $dm->persist($form->getData());
                $dm->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Your changes were saved!'
                );

                return $this->redirect($this->generateUrl('stasmo_panax_bio'));
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:edit.html.twig', array( 'form' => $form->createView() ));
    }

    protected function getBioForm($bio = null)
    {
        if (empty($bio)) {
            $bio = new Biography();
        }
        return $this->createFormBuilder($bio)
            ->setMethod('POST')
            ->add('body', 'ckeditor')
            ->add('imageLocation', 'text')
            ->add('save', 'submit')
            ->getForm();
    }
}
