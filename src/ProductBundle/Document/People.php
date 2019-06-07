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

/**
 * @MongoDB\Document(collection="people")
 * @MongoDBUnique(fields="name")
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
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $country;
    
    /**
     * @Assert\Type(type="ProductBundle\Document\States")
     */
    protected $states;

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
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }
        
    public function setStates(States $states)
    {
        $this->states = $states;
    }

    public function getStates()
    {
        //dump($this->states);die;
        return $this->states;
    }
}
