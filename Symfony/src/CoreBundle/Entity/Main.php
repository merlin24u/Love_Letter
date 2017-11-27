<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Main
 *
 * @ORM\Table(name="Main")
 * @ORM\Entity
 */
class Main {

    /**
     * @var integer
     *
     * @ORM\Column(name="idMain", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmain;

    /**
     * @var \Joueur
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Joueur", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLogin", referencedColumnName="id")
     * })
     */
    private $idlogin;

    /**
     * @var \Tour
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tour", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTour", referencedColumnName="idTour")
     * })
     */
    private $idtour;

    /**
     * Set idmain
     *
     * @param integer $idmain
     *
     * @return Main
     */
    public function setIdmain($idmain) {
        $this->idmain = $idmain;

        return $this;
    }

    /**
     * Get idmain
     *
     * @return integer
     */
    public function getIdmain() {
        return $this->idmain;
    }

    /**
     * Set cartejouee
     *
     * @param string $cartejouee
     *
     * @return Main
     */
    public function setCartejouee($cartejouee) {
        $this->cartejouee = $cartejouee;

        return $this;
    }

    /**
     * Get cartejouee
     *
     * @return string
     */
    public function getCartejouee() {
        return $this->cartejouee;
    }

    /**
     * Set idlogin
     *
     * @param \CoreBundle\Entity\Joueur $login
     *
     * @return Main
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
     * Set idtour
     *
     * @param \CoreBundle\Entity\Tour $idtour
     *
     * @return Main
     */
    public function setIdtour(\CoreBundle\Entity\Tour $idtour) {
        $this->idtour = $idtour;

        return $this;
    }

    /**
     * Get idtour
     *
     * @return \CoreBundle\Entity\Tour
     */
    public function getIdtour() {
        return $this->idtour;
    }

}
