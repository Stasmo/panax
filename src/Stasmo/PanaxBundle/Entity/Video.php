<?php

namespace Stasmo\PanaxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Video
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
     * @return Video
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
     * @return Video
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
     * Set displayOrder
     *
     * @param integer $displayOrder
     * @return Video
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
}