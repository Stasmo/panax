<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Stasmo\PanaxBundle\Entity\Music;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/music")
 */
class MusicController extends Controller
{
    public function indexAction()
    {
        $lefts = $this
            ->get('doctrine')
            ->getRepository('StasmoPanaxBundle:Music')
            ->findBy(['displayLeft' => true], ['displayOrder' => 'asc']);
        $rights = $this
            ->get('doctrine')
            ->getRepository('StasmoPanaxBundle:Music')
            ->findBy(['displayLeft' => false], ['displayOrder' => 'asc']);
        return $this->render('StasmoPanaxBundle:Music:index.html.twig', ['lefts' => $lefts, 'rights' => $rights]);
    }

    /**
     * @Route("/list", name="list_music")
     */
    public function listAction()
    {   
        $musics = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Music')
                ->findAll();

        return $this->render('StasmoPanaxBundle:Music:list.html.twig', array( 'musics' => $musics ));
    }

    /**
     * @Route("/new", name="music_new")
     */
    public function newAction(Request $request)
    {
    	$music = new Music();
    	$form = $this->getMusicForm($music);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $dm = $this->get('doctrine')->getManager();
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
    public function editAction(Request $request, $id)
    {
        $music = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Music')
                ->findOneById($id);
    	$form = $this->getMusicForm($music);

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
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Music')
                ->findOneById($id);

        if (empty($music)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'No music with the provided ID'
            );

            return $this->redirect($this->generateUrl('list_music'));
        }
        $request = $this->getRequest();

        $dm = $this->get('doctrine')->getManager();
        $dm->remove($music);
        $dm->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Successfully deleted music'
        );

        return $this->redirect($this->generateUrl('list_music'));
    }

    protected function getMusicForm($music = null)
    {
        if (empty($music)) {
            $music = new Music();
        }
        return $this->createFormBuilder($music)
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('embedString', 'text')
            ->add('displayLeft', 'checkbox', [ 'required' => false, 'label' => 'Display this on the left side of the music page' ])
            ->add('displayOnHome', 'checkbox', [ 'required' => false, 'label' => 'Display this on the home page' ])
            ->add('displayOrder', 'integer')
            ->add('save', 'submit')
            ->getForm();
    }
}
