<?php

namespace Stasmo\PanaxBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Music
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
    protected $embedString;

    /**
     * @MongoDB\Boolean
     */
    protected $left;

    /**
     * @MongoDB\Int
     */
    protected $order;

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
     * Set embedString
     *
     * @param string $embedString
     * @return self
     */
    public function setEmbedString($embedString)
    {
        $this->embedString = $embedString;
        return $this;
    }

    /**
     * Get embedString
     *
     * @return string $embedString
     */
    public function getEmbedString()
    {
        return $this->embedString;
    }

    /**
     * Set left
     *
     * @param boolean $left
     * @return self
     */
    public function setLeft($left)
    {
        $this->left = $left;
        return $this;
    }

    /**
     * Get left
     *
     * @return boolean $left
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set order
     *
     * @param int $order
     * @return self
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return int $order
     */
    public function getOrder()
    {
        return $this->order;
    }
}
