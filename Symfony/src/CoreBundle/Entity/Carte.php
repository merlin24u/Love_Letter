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
     * @var integer
     * 
     * @ORM\Column(name="idCarte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY") 
     */
    private $idcarte;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
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
     * @ORM\Column(name="effet", type="string", length=200, nullable=true)
     */
    private $effet;

    public function getIdcarte() {
        return $this->idcarte;
    }

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
    
}
