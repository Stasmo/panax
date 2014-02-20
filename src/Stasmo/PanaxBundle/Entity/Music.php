<?php

namespace Stasmo\PanaxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="music")
 */
class Music
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $embedString;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $left;

    /**
     * @ORM\Column(type="integer")
     */
    protected $order;

}
