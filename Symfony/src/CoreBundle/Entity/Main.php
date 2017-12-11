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
     * @ORM\ManyToOne(targetEntity="Joueur", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLogin", referencedColumnName="id")
     * })
     */
    private $idlogin;

    /**
     * @var \Manche
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Manche", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idManche", referencedColumnName="idManche")
     * })
     */
    private $idmanche;

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
     * Set idmanche
     *
     * @param \CoreBundle\Entity\Manche $manche
     *
     * @return Main
     */
    public function setIdmanche($manche) {
        $this->idmanche = $manche;

        return $this;
    }

    /**
     * Get idtour
     *
     * @return \CoreBundle\Entity\Manche
     */
    public function getIdmanche() {
        return $this->idmanche;
    }

}
