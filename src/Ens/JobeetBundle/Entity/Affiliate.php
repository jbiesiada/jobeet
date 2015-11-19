<?php

namespace Ens\JobeetBundle\Entity;

/**
 * Affiliate
 */
class Affiliate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $category_affiliates;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category_affiliates = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set url
     *
     * @param string $url
     *
     * @return Affiliate
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Affiliate
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Affiliate
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Affiliate
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Add categoryAffiliate
     *
     * @param \Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliate
     *
     * @return Affiliate
     */
    public function addCategoryAffiliate(\Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliate)
    {
        $this->category_affiliates[] = $categoryAffiliate;

        return $this;
    }

    /**
     * Remove categoryAffiliate
     *
     * @param \Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliate
     */
    public function removeCategoryAffiliate(\Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliate)
    {
        $this->category_affiliates->removeElement($categoryAffiliate);
    }

    /**
     * Get categoryAffiliates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryAffiliates()
    {
        return $this->category_affiliates;
    }

    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }
    /**
     * @var boolean
     */
    private $is_active;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Affiliate
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;


    /**
     * Add category
     *
     * @param \Ens\JobeetBundle\Entity\Category $category
     *
     * @return Affiliate
     */
    public function addCategory(\Ens\JobeetBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Ens\JobeetBundle\Entity\Category $category
     */
    public function removeCategory(\Ens\JobeetBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function setTokenValue()
    {
        if(!$this->getToken())
        {
            $token = sha1($this->getEmail().rand(11111, 99999));
            $this->token = $token;
        }
        return $this;
    }
    public function activate()
    {
        if(!$this->getIsActive())
        {
            $this->setIsActive(true);
        }

        return $this->is_active;
    }

    public function deactivate()
    {
        if($this->getIsActive())
        {
            $this->setIsActive(false);
        }

        return $this->is_active;
    }
}
