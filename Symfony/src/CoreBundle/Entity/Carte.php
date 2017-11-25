<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carte
 *
 * @ORM\Table(name="Carte")
 * @ORM\Entity
 */
class Carte {

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer", nullable=true)
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="effet", type="string", length=50, nullable=true)
     */
    private $effet;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=50, nullable=true)
     */
    private $img;

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     *
     * @return Carte
     */
    public function setValeur($valeur) {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer
     */
    public function getValeur() {
        return $this->valeur;
    }

    /**
     * Set effet
     *
     * @param string $effet
     *
     * @return Carte
     */
    public function setEffet($effet) {
        $this->effet = $effet;

        return $this;
    }

    /**
     * Get effet
     *
     * @return string
     */
    public function getEffet() {
        return $this->effet;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Carte
     */
    public function setImg($img) {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg() {
        return $this->img;
    }

}
