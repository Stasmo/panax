<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Stasmo\PanaxBundle\Entity\Video;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/videos")
 */
class VideosController extends Controller
{
    public function indexAction()
    {
        $videos = $this
            ->get('doctrine')
            ->getRepository('StasmoPanaxBundle:Video')
            ->findAll();
        return $this->render('StasmoPanaxBundle:Videos:index.html.twig', ['videos' => $videos]);
    }

    /**
     * @Route("/list", name="list_videos")
     */
    public function listAction()
    {   
        $videos = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Video')
                ->findAll();

        return $this->render('StasmoPanaxBundle:Videos:list.html.twig', array( 'videos' => $videos ));
    }

    /**
     * @Route("/new", name="videos_new")
     */
    public function newAction(Request $request)
    {
    	$video = new Video();
    	$form = $this->getVideoForm($video);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $dm = $this->get('doctrine')->getManager();
                $dm->persist($form->getData());
                $dm->flush();

                return $this->redirect($this->generateUrl('list_videos'));
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:new.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/edit/{id}", name="edit_video")
     */
    public function editAction(Request $request, $id)
    {
        $video = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Video')
                ->findOneById($id);
    	$form = $this->getVideoForm($video);

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

                return $this->redirect($this->generateUrl('list_videos'));
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/delete/{id}", name="delete_video")
     */
    public function deleteAction(Request $request, $id)
    {
        $video = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Video')
                ->findOneById($id);

        if (empty($video)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'No video with the provided ID'
            );

            return $this->redirect($this->generateUrl('list_videos'));
        }

        $dm = $this->get('doctrine')->getManager();
        $dm->remove($video);
        $dm->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Successfully deleted video'
        );

        return $this->redirect($this->generateUrl('list_videos'));
    }

    protected function getVideoForm($video = null)
    {
        if (empty($video)) {
            $video = new Video();
        }
        return $this->createFormBuilder($video)
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('embedString', 'text')
            ->add('displayOrder', 'integer')
            ->add('save', 'submit')
            ->getForm();
    }
}
