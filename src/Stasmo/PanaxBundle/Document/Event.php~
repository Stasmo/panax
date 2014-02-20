<?php

namespace Stasmo\PanaxBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Event
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @MongoDB\String
     */
    protected $eventLink;

    /**
     * @MongoDB\Date
     */
    protected $date;

    /**
     * @MongoDB\String
     */
    protected $ticketText;

    /**
     * @MongoDB\String
     */
    protected $ticketLink;

    /**
     * @MongoDB\String
     */
    protected $description;

    /** 
     * @MongoDB\String
     */
    private $imageLocation;

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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    public function getFormattedDate()
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    /**
     * Set ticketText
     *
     * @param string $ticketText
     * @return self
     */
    public function setTicketText($ticketText)
    {
        $this->ticketText = $ticketText;
        return $this;
    }

    /**
     * Get ticketText
     *
     * @return string $ticketText
     */
    public function getTicketText()
    {
        return $this->ticketText;
    }

    /**
     * Set ticketLink
     *
     * @param string $ticketLink
     * @return self
     */
    public function setTicketLink($ticketLink)
    {
        $this->ticketLink = $ticketLink;
        return $this;
    }

    /**
     * Get ticketLink
     *
     * @return string $ticketLink
     */
    public function getTicketLink()
    {
        return $this->ticketLink;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set eventLink
     *
     * @param string $eventLink
     * @return self
     */
    public function setEventLink($eventLink)
    {
        $this->eventLink = $eventLink;
        return $this;
    }

    /**
     * Get eventLink
     *
     * @return string $eventLink
     */
    public function getEventLink()
    {
        return $this->eventLink;
    }

    /**
     * Set imageLocation
     *
     * @param string $imageLocation
     * @return self
     */
    public function setImageLocation($imageLocation)
    {
        $this->imageLocation = $imageLocation;
        return $this;
    }

    /**
     * Get imageLocation
     *
     * @return string $imageLocation
     */
    public function getImageLocation()
    {
        return $this->imageLocation;
    }
}
