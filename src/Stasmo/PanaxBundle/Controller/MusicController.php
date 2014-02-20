<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Stasmo\PanaxBundle\Document\Music;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/music")
 */
class MusicController extends Controller
{
    public function indexAction()
    {
        return $this->render('StasmoPanaxBundle:Music:index.html.twig');
    }

    /**
     * @Route("/list", name="list_music")
     */
    public function listAction()
    {   
        $musics = $this
                ->get('doctrine_mongodb')
                ->getRepository('StasmoPanaxBundle:Music')
                ->findBy([], [ 'uploadDate' => 'DESC' ]);

        return $this->render('StasmoPanaxBundle:Music:list.html.twig', array( 'musics' => $musics ));
    }

    /**
     * @Route("/new")
     */
    public function newAction(Request $request)
    {
    	$music = new Music();
    	$form = $this->createFormBuilder($music)
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('embedString', 'text')
            ->add('left', 'checkbox', [ 'required' => false, 'label' => 'Display this on the left side of the music page' ])
            ->add('order', 'integer')
            ->add('save', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($form->getData());
                $dm->flush();

                return $this->redirect($this->generateUrl('list_music'));
            }
        }

        return $this->render('StasmoPanaxBundle:Music:new.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/edit/{id}", name="edit_music")
     */
    public function editAction($id)
    {
        $music = $this
                ->get('doctrine_mongodb')
                ->getRepository('StasmoPanaxBundle:Music')
                ->findOneById($id);

    	$form = $this->createFormBuilder($music)
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('embedString', 'text')
            ->add('left', 'checkbox', [ 'required' => false, 'label' => 'Display this on the left side of the music page' ])
            ->add('order', 'integer')
            ->add('save', 'submit')
            ->getForm();
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $dm->persist($form->getData());
                $dm->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Your changes were saved!'
                );

                return $this->redirect($this->generateUrl('list_music'));
            }
        }

        return $this->render('StasmoPanaxBundle:Music:new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/delete/{id}", name="delete_music")
     */
    public function deleteAction($id)
    {
        $music = $this
                ->get('doctrine_mongodb')
                ->getRepository('StasmoPanaxBundle:Music')
                ->findOneById($id);

        if (empty($music)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'No images with the provided ID'
            );

            return $this->redirect($this->generateUrl('list_music'));
        }
        $request = $this->getRequest();

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->remove($music);
        $dm->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Successfully deleted music'
        );

        return $this->redirect($this->generateUrl('list_music'));
    }
}
