<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ProductBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Symfony\Component\Validator\Constraints as Assert;
use ProductBundle\Document\Country;

/**
 * @MongoDB\Document(collection="states")
 * @MongoDBUnique(fields="id")
 */
class States {
    
    /**
     * @MongoDB\Id
     */
    protected $id;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="Country")
     */
    protected $country;
    
    /**
     * @MongoDB\Field(type="string"))
     * @Assert\NotBlank()
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
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }
}
