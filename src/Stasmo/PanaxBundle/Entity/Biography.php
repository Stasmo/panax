<?php

namespace Stasmo\PanaxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Biography
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Biography
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
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="imageLocation", type="text")
     */
    private $imageLocation;


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
     * Set body
     *
     * @param string $body
     * @return Biography
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set imageLocation
     *
     * @param string $imageLocation
     * @return Biography
     */
    public function setImageLocation($imageLocation)
    {
        $this->imageLocation = $imageLocation;
    
        return $this;
    }

    /**
     * Get imageLocation
     *
     * @return string 
     */
    public function getImageLocation()
    {
        return $this->imageLocation;
    }
}