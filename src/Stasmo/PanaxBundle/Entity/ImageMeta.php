<?php

namespace Stasmo\PanaxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImageMeta
 *
 * @ORM\Table(name="imageMeta")
 * @ORM\Entity
 */
class ImageMeta
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
     * @ORM\Column(name="caption", type="text", nullable=true)
     */
    private $caption;

    /**
     * @var string
     *
     * @ORM\Column(name="fileName", type="string", length=255)
     */
    private $fileName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploadDate", type="datetime")
     */
    private $uploadDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="display", type="boolean")
     */
    private $display;


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
     * Set caption
     *
     * @param string $caption
     * @return ImageMeta
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    
        return $this;
    }

    /**
     * Get caption
     *
     * @return string 
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return ImageMeta
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    
        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set uploadDate
     *
     * @param \DateTime $uploadDate
     * @return ImageMeta
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;
    
        return $this;
    }

    /**
     * Get uploadDate
     *
     * @return \DateTime 
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
    }

    /**
     * Set display
     *
     * @param boolean $display
     * @return ImageMeta
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    
        return $this;
    }

    /**
     * Get display
     *
     * @return boolean 
     */
    public function getDisplay()
    {
        return $this->display;
    }

    public function getFormattedUploadDate()
    {
        if ($this->uploadDate) {
            return $this->uploadDate->format('d/m/y g:i A');
        }
    }

    public function getWebLocation()
    {
        return '/uploaded/pictures/' . $this->fileName;
    }
}