<?php

namespace PW\EvmeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filter
 *
 * @ORM\Table(name="filter")
 * @ORM\Entity(repositoryClass="PW\EvmeetBundle\Repository\FilterRepository")
 */
class Filter
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
     * @ORM\Column(name="lieu", type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInvitation", type="datetime", nullable=true)
     */
    private $dateInvitation;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveau", type="integer", nullable=true)
     */
    private $niveau;




    /**
     * Get id
     *
     * @return int
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
     * @return Filter
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
     * @return Filter
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
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Filter
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }
}
