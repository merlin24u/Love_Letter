<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deck
 *
 * @ORM\Table(name="Deck")
 * @ORM\Entity
 */
class Deck {

    /**
     * @var integer
     *
     * @ORM\Column(name="idDeck", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddeck;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLogin", referencedColumnName="id")
     * })
     */
    private $idlogin;

    /**
     * @var \Manche
     *
     * @ORM\ManyToOne(targetEntity="Manche", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idManche", referencedColumnName="idManche")
     * })
     */
    private $idmanche;

    /**
     * Set iddeck
     *
     * @param integer $iddeck
     *
     * @return Deck
     */
    public function setIddeck($iddeck) {
        $this->iddeck = $iddeck;

        return $this;
    }

    /**
     * Get iddeck
     *
     * @return integer
     */
    public function getIddeck() {
        return $this->iddeck;
    }

    /**
     * Set idlogin
     *
     * @param \CoreBundle\Entity\Joueur $login
     *
     * @return Deck
     */
    public function setIdlogin(\CoreBundle\Entity\Joueur $login) {
        $this->idlogin = $login;

        return $this;
    }

    /**
     * Get idlogin
     *
     * @return \CoreBundle\Entity\Joueur
     */
    public function getIdlogin() {
        return $this->idlogin;
    }

    /**
     * Set idmanche
     *
     * @param \CoreBundle\Entity\Manche $idmanche
     *
     * @return Deck
     */
    public function setIdmanche(\CoreBundle\Entity\Manche $idmanche = null) {
        $this->idmanche = $idmanche;

        return $this;
    }

    /**
     * Get idmanche
     *
     * @return \CoreBundle\Entity\Manche
     */
    public function getIdmanche() {
        return $this->idmanche;
    }

}
