<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Stasmo\PanaxBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/events")
 */
class EventsController extends Controller
{
    public function indexAction()
    {
        $events = $this
            ->get('doctrine')
            ->getRepository('StasmoPanaxBundle:Event')
            ->findBy([], ['date' => 'desc']);
        return $this->render('StasmoPanaxBundle:Events:index.html.twig', ['events' => $events]);
    }

    /**
     * @Route("/list", name="list_event")
     */
    public function listAction()
    {   
        $events = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Event')
                ->findBy([], ['date' => 'desc']);

        return $this->render('StasmoPanaxBundle:Events:list.html.twig', array( 'events' => $events ));
    }

    /**
     * @Route("/new", name="event_new")
     */
    public function newAction(Request $request)
    {
    	$event = new Event();
    	$form = $this->getEventForm($event);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $dm = $this->get('doctrine')->getManager();
                $dm->persist($form->getData());
                $dm->flush();

                return $this->redirect($this->generateUrl('list_event'));
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:new.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/edit/{id}", name="edit_event")
     */
    public function editAction(Request $request, $id)
    {
        $event = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Event')
                ->findOneById($id);
    	$form = $this->getEventForm($event);

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

                return $this->redirect($this->generateUrl('list_event'));
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:edit.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/delete/{id}", name="delete_event")
     */
    public function deleteAction($id)
    {
        $event = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:Event')
                ->findOneById($id);

        if (empty($event)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'No event with the provided ID'
            );

            return $this->redirect($this->generateUrl('list_event'));
        }
        $request = $this->getRequest();

        $dm = $this->get('doctrine')->getManager();
        $dm->remove($event);
        $dm->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Successfully deleted event'
        );

        return $this->redirect($this->generateUrl('list_event'));
    }

    protected function getEventForm($event = null)
    {
        if (empty($event)) {
            $event = new Event();
        }
        return $this->createFormBuilder($event)
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('eventLink', 'url', ['required'=>false])
            ->add('ticketLink', 'url', ['required'=>false])
            ->add('ticketText', 'text', ['required'=>false])
            ->add('description', 'ckeditor')
            ->add('date', 'datetime')
            ->add('imageLocation', 'text', ['required'=>false])
            ->add('save', 'submit')
            ->getForm();
    }
}
