<?php

namespace Stasmo\PanaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Stasmo\PanaxBundle\Document\Image;
use Stasmo\PanaxBundle\Entity\ImageMeta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Route("/pics")
 */
class PicturesController extends Controller
{

	/**
	 * @Route("", name="stasmo_panax_pics")
     * @Cache(expires="tomorrow")
	 */
    public function indexAction()
    {
        $pics = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:ImageMeta')
                ->findBy([ 'display' => true ], [ 'uploadDate' => 'DESC' ]);

        return $this->render('StasmoPanaxBundle:Pictures:index.html.twig', array( 'images' => $pics ));
    }

    /**
     * @Route("/new", name="add_image")
     */
    public function newAction(Request $request)
    {
    	$image = new Image();
    	$form = $this->createFormBuilder($image)
            ->setMethod('POST')
            ->add('caption', 'text', ['required' => false])
            ->add('file', 'file')
            ->add('display', 'checkbox', array( 'required' => false ))
            ->add('save', 'submit')
            ->getForm();
        $logger = $this->get('logger');

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                //$logger->info(print_r($form->getData(),1));
                $path = $request->server->get('DOCUMENT_ROOT') . '/uploaded/pictures';
                $date = new \DateTime();
                $dm = $this->get('doctrine')->getManager();
                foreach($request->files as $uploadedFile) {
                    //$logger->info("uploaded" . print_r($uploadedFile,1));
                    $file = $uploadedFile['file'];
                    $imageMeta = new ImageMeta();
                    $imageMeta->setDisplay($form->getData()->getDisplay());
                    $imageMeta->setFileName($file->getClientOriginalName());
                    $imageMeta->setCaption($form->getData()->getCaption());
                    $imageMeta->setUploadDate($date);
                    $name = $imageMeta->getFileName();
                    while (file_exists($path . '/' . $imageMeta->getFileName())){
                        $imageMeta->setFileName('0' . $imageMeta->getFileName());
                    }
                    $file->move($path, $imageMeta->getFileName());
                    $dm->persist($imageMeta);
                    $dm->flush();
                }


                return $this->redirect($this->generateUrl('list_images'));
            }
        }

        return $this->render('StasmoPanaxBundle:Pictures:new.html.twig', array( 'form' => $form->createView() ));
    }

    protected function clearCache()
    {
        
    }

    /**
     * @Route("/list", name="list_images")
     */
    public function listAction()
    {   
        $pics = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:ImageMeta')
                ->findBy([], [ 'uploadDate' => 'DESC' ]);

        return $this->render('StasmoPanaxBundle:Pictures:list.html.twig', array( 'images' => $pics ));
    }


    /**
     * @Route("/edit/{id}", name="edit_image")
     */
    public function editAction(Request $request, $id)
    {
        $image = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:ImageMeta')
                ->findOneById($id);

        if (empty($image)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'No images with the provided ID'
            );

            return $this->redirect($this->generateUrl('list_images'));
        }
        $imageNameBefore = $image->getFileName();
        $form = $this->createFormBuilder($image)
            ->setMethod('POST')
            ->add('caption', 'text', ['required' => false])
            ->add('fileName', 'text')
            ->add('display', 'checkbox', array( 'required' => false ))
            ->add('save', 'submit')
            ->getForm();
        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                //$logger->info(print_r($form->getData(),1));
                $path = $request->server->get('DOCUMENT_ROOT') . '/uploaded/pictures';
                $date = new \DateTime();
                $dm = $this->get('doctrine')->getManager();

                if ($form->getData()->getFileName() !== $imageNameBefore) {
                    if (file_exists($path . '/' . $form->getData()->getFileName())) {
                        $this->get('session')->getFlashBag()->add(
                            'error',
                            'A file with that name already exists'
                        );

                        return $this->render('StasmoPanaxBundle:Shared:edit.html.twig', array( 'form' => $form->createView() ));
                    }

                    if (file_exists($path . '/' . $imageNameBefore)) {
                        $file = new File($path . '/' . $imageNameBefore);
                        $file->move($path . '/', $form->getData()->getFileName());
                        $this->get('session')->getFlashBag()->add(
                            'success',
                            'Renamed file successfully'
                        );
                    }

                }

                $dm->persist($form->getData());
                $dm->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Your changes were saved!'
                );

                return $this->redirect($this->generateUrl('list_images'));
            }
        }

        return $this->render('StasmoPanaxBundle:Pictures:new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/delete/{id}", name="delete_image")
     */
    public function deleteAction(Request $request, $id)
    {
        $image = $this
                ->get('doctrine')
                ->getRepository('StasmoPanaxBundle:ImageMeta')
                ->findOneById($id);

        if (empty($image)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'No images with the provided ID'
            );

            return $this->redirect($this->generateUrl('list_images'));
        }

        $path = $request->server->get('DOCUMENT_ROOT') . '/uploaded/pictures';
        if (file_exists($path . '/' . $image->getFileName())) {
            unlink($path . '/' . $image->getFileName());
        }

        $dm = $this->get('doctrine')->getManager();
        $dm->remove($image);
        $dm->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Successfully deleted image'
        );

        return $this->redirect($this->generateUrl('list_images'));
    }

}
