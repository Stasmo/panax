<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Stasmo\PanaxBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/posts")
 */
class PostsController extends Controller
{

    /**
     * @Route("/list", name="posts_list")
     */
    public function listAction()
    {
    	$posts = $this
			->get('doctrine')
	        ->getRepository('StasmoPanaxBundle:Post')
	        ->findBy([], [ 'date' => 'DESC' ]);

        return $this->render('StasmoPanaxBundle:Posts:list.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/edit/{id}", name="posts_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this
            ->get('doctrine')->getManager();
        $post = $em->getRepository('StasmoPanaxBundle:Post')
            ->findOneById($id);
        if (empty($post)) {
            $this->get('session')->getFlashBag()->add('error','No post with that ID');
            return $this->redirect($this->generateUrl('posts_list'));
        }
        $form = $this->getPostForm($post);


        if ('POST' === $request->getMethod()) {
            $form->submit($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine')->getManager();
                $em->persist($form->getData());
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success', 'Post saved'
                );
                return $this->redirect($this->generateUrl('posts_list'));
            } else {

                $this->get('session')->getFlashBag()->add(
                    'error', 'Form invalid'
                );
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:edit.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/new", name="posts_new")
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->getPostForm($post);

        if ('POST' === $request->getMethod()) {
            $form->submit($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine')->getManager();
                $em->persist($form->getData());
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success', 'Post created'
                );
                return $this->redirect($this->generateUrl('posts_list'));
            } else {

                $this->get('session')->getFlashBag()->add(
                    'error', 'Form invalid'
                );
            }
        }

        return $this->render('StasmoPanaxBundle:Shared:new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/delete/{id}", name="posts_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this
            ->get('doctrine')->getManager();
        $post = $em->getRepository('StasmoPanaxBundle:Post')
            ->findOneById($id);

        $em->remove($post);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success', 'Post deleted'
        );
        return $this->redirect($this->generateUrl('posts_list'));
    }

    protected function getPostForm($post = null)
    {
        if (empty($post)) {
            $post = new Post();
        }

        return $this->createFormBuilder($post)
            ->setMethod('POST')
            ->add('title', 'text')
            ->add('body', 'ckeditor')
            ->add('date', 'datetime')
            ->add('display', 'checkbox', ['required' => false])
            ->add('save', 'submit')
            ->getForm();

    }
}
