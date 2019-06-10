<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ProductBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use ProductBundle\Document\States;
use ProductBundle\Document\Country;

/**
 * @MongoDB\Document(collection="people")
 * @MongoDBUnique(fields="id")
 */
class People {
    
    /**
     * @MongoDB\Id
     */
    protected $id;
    
    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank())
     */
    protected $name;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="Country")
     */
    protected $country;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="States")
     */
    protected $state;


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
     * @return $this
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
     * Set country
     *
     * @param ProductBundle\Document\Country $country
     * @return $this
     */
    public function setCountry(\ProductBundle\Document\Country $country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return ProductBundle\Document\Country $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param ProductBundle\Document\States $state
     * @return $this
     */
    public function setState(\ProductBundle\Document\States $state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return ProductBundle\Document\States $state
     */
    public function getState()
    {
        return $this->state;
    }
}
