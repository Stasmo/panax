<?php

namespace Stasmo\PanaxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Music
 *
 * @ORM\Table(name="music")
 * @ORM\Entity
 */
class Music
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="embedString", type="text")
     */
    private $embedString;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayLeft", type="boolean")
     */
    private $displayLeft;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayOnHome", type="boolean")
     */
    private $displayOnHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="displayOrder", type="integer")
     */
    private $displayOrder;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Music
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set embedString
     *
     * @param string $embedString
     * @return Music
     */
    public function setEmbedString($embedString)
    {
        $this->embedString = $embedString;
    
        return $this;
    }

    /**
     * Get embedString
     *
     * @return string 
     */
    public function getEmbedString()
    {
        return $this->embedString;
    }

    /**
     * Set displayLeft
     *
     * @param boolean $displayLeft
     * @return Music
     */
    public function setDisplayLeft($displayLeft)
    {
        $this->displayLeft = $displayLeft;
    
        return $this;
    }

    /**
     * Get displayLeft
     *
     * @return boolean 
     */
    public function getDisplayLeft()
    {
        return $this->displayLeft;
    }

    /**
     * Set displayOrder
     *
     * @param integer $displayOrder
     * @return Music
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;
    
        return $this;
    }

    /**
     * Get displayOrder
     *
     * @return integer 
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * Set displayOnHome
     *
     * @param boolean $displayOnHome
     * @return Music
     */
    public function setDisplayOnHome($displayOnHome)
    {
        $this->displayOnHome = $displayOnHome;
    
        return $this;
    }

    /**
     * Get displayOnHome
     *
     * @return boolean 
     */
    public function getDisplayOnHome()
    {
        return $this->displayOnHome;
    }
}