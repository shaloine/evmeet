<?php
// src/EvmeetBundle/Entity/User.php

namespace PW\EvmeetBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="PW\EvmeetBundle\Entity\Article", mappedBy="user")
     */
  	private $articles;

  	/**
     * @ORM\OneToMany(targetEntity="PW\EvmeetBundle\Entity\Comment", mappedBy="user")
     */
  	private $comments;

    public function __construct()
    {
        parent::__construct();
        
        $this->articles = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->roles[] = 'ROLE_USER';
    }

    /**
     * Add article
     *
     * @param \PW\EvmeetBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\PW\EvmeetBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \PW\EvmeetBundle\Entity\Article $article
     */
    public function removeArticle(\PW\EvmeetBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add comment
     *
     * @param \PW\EvmeetBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\PW\EvmeetBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \PW\EvmeetBundle\Entity\Comment $comment
     */
    public function removeComment(\PW\EvmeetBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
