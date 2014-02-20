<?php
// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Stasmo\PanaxBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Event Name'))
            ->add('eventLink', 'text', array('label' => 'Event Link', 'required'=>false))
            ->add('date', 'datetime')
            ->add('ticketText', 'text', array('label' => 'Ticket Text'))
            ->add('ticketLink', 'text', array('label' => 'Ticket Link',  'required'=>false))
            ->add('description', 'text') //if no type is specified, SonataAdminBundle tries to guess it
            ->add('imageLocation', 'text', array('label' => 'Event image link', 'required' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('date')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('date')
        ;
    }
}