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
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @MongoDB\Document(collection="states")
 * @MongoDBUnique(fields="country")
 */
class States {
    
    /**
     * @MongoDB\Id
     */
    protected $id;
    
    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank())
     */
    protected $country;
    
    /**
     * @MongoDB\Field(type="collection")
     * @Assert\NotBlank()
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

    /**
     * Set states
     *
     * @param collection $states
     * @return $this
     */
    public function setStates($states)
    {
        $this->states = $states;
        return $this;
    }

    /**
     * Get states
     *
     * @return collection $states
     */
    public function getStates()
    {
        return $this->states;
    }
}
