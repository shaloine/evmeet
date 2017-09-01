<?php

namespace PW\EvmeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filter
 *
 * @ORM\Table(name="RegistredUser")
 * @ORM\Entity(repositoryClass="PW\EvmeetBundle\Repository\RegistredUserRepository")
 */
class RegistredUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

        /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer", nullable=true)
     */
    private $userId;

        /**
     * @var integer
     *
     * @ORM\Column(name="articleId", type="integer", nullable=true)
     */
    private $articleId;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return RegistredUser
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set articleId
     *
     * @param integer $articleId
     *
     * @return RegistredUser
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * Get articleId
     *
     * @return integer
     */
    public function getArticleId()
    {
        return $this->articleId;
    }
}
