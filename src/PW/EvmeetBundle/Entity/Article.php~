<?php

namespace PW\EvmeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use DateTimeZone;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="PW\EvmeetBundle\Repository\ArticleRepository")
 */
class Article
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
     * @var string
     *
     * @ORM\Column(name="lieu", type="text", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInvitation", type="datetime")
     */
    private $dateInvitation;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveauMin", type="integer")
     */
    private $niveauMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveauMax", type="integer")
     */
    private $niveauMax;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbPlace", type="integer")
     */
    private $nbPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

     /**
     * @ORM\ManyToOne(targetEntity="PW\EvmeetBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    public function __construct()
    {
      $this->dateInvitation = new Datetime();
      $this->dateInvitation->setTimezone(new DateTimeZone('Europe/Paris'));
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
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Article
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set dateInvitation
     *
     * @param \DateTime $dateInvitation
     *
     * @return Article
     */
    public function setDateInvitation($dateInvitation)
    {
        $this->dateInvitation = $dateInvitation;

        return $this;
    }

    /**
     * Get dateInvitation
     *
     * @return \DateTime
     */
    public function getDateInvitation()
    {
        return $this->dateInvitation;
    }

    /**
     * Set niveauMin
     *
     * @param integer $niveauMin
     *
     * @return Article
     */
    public function setNiveauMin($niveauMin)
    {
        $this->niveauMin = $niveauMin;

        return $this;
    }

    /**
     * Get niveauMin
     *
     * @return integer
     */
    public function getNiveauMin()
    {
        return $this->niveauMin;
    }

    /**
     * Set niveauMax
     *
     * @param integer $niveauMax
     *
     * @return Article
     */
    public function setNiveauMax($niveauMax)
    {
        $this->niveauMax = $niveauMax;

        return $this;
    }

    /**
     * Get niveauMax
     *
     * @return integer
     */
    public function getNiveauMax()
    {
        return $this->niveauMax;
    }

    /**
     * Set commentaire
     *
     * @param \DateTime $commentaire
     *
     * @return Article
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return \DateTime
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set user
     *
     * @param \PW\EvmeetBundle\Entity\User $user
     *
     * @return Article
     */
    public function setUser(\PW\EvmeetBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PW\EvmeetBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set nbPlace
     *
     * @param integer $nbPlace
     *
     * @return Article
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    /**
     * Get nbPlace
     *
     * @return integer
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     *
     * @return Article
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }
}
