<?php

namespace Stasmo\PanaxBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 *  @MongoDB\Document 
 */
class ImageMeta
{
    /**
     *  @MongoDB\Id 
     */
    private $id;

    /**
     *  @MongoDB\String 
     */
    private $fileName;

    /**
     *  @MongoDB\String 
     */
    private $caption;

    /**
     *  @MongoDB\Date 
     */
    private $uploadDate;

    /**
     *  @MongoDB\Boolean
     */
    private $display;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return self
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Get fileName
     *
     * @return string $fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set caption
     *
     * @param string $caption
     * @return self
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * Get caption
     *
     * @return string $caption
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set uploadDate
     *
     * @param date $uploadDate
     * @return self
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;
        return $this;
    }

    /**
     * Get uploadDate
     *
     * @return date $uploadDate
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
    }

    /**
     * Set display
     *
     * @param boolean $display
     * @return self
     */
    public function setDisplay($display)
    {
        $this->display = $display;
        return $this;
    }

    /**
     * Set display
     *
     * @return boolean $display
     */
    public function getDisplay()
    {
        return $this->display;
    }

    public function getFormattedUploadDate()
    {
        return $this->uploadDate->format('Y-m-d H:i:s');
    }

    public function getWebLocation()
    {
        return '/uploaded/pictures/' . $this->fileName;
    }

}
