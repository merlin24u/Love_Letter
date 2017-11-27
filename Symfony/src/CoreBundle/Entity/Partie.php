<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partie
 *
 * @ORM\Table(name="Partie")
 * @ORM\Entity
 */
class Partie {

    /**
     * @var integer
     *
     * @ORM\Column(name="idPartie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpartie;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbJoueurs", type="integer", nullable=true)
     */
    private $nbjoueurs;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gagnant", referencedColumnName="id")
     * })
     */
    private $gagnant;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="token", type="boolean", nullable=true) 
     */
    private $ouverte;

    public function getOuverte() {
        return $this->ouverte;
    }

    public function setOuverte($o) {
        $this->ouverte = $o;

        return $this;
    }

    /**
     * Get idpartie
     *
     * @return integer
     */
    public function getIdpartie() {
        return $this->idpartie;
    }

    /**
     * Set nbjoueurs
     *
     * @param integer $nbjoueurs
     *
     * @return Partie
     */
    public function setNbjoueurs($nbjoueurs) {
        $this->nbjoueurs = $nbjoueurs;

        return $this;
    }

    /**
     * Get nbjoueurs
     *
     * @return integer
     */
    public function getNbjoueurs() {
        return $this->nbjoueurs;
    }

    /**
     * Set gagnant
     *
     * @param \CoreBundle\Entity\Joueur $gagnant
     *
     * @return Partie
     */
    public function setGagnant(\CoreBundle\Entity\Joueur $gagnant = null) {
        $this->gagnant = $gagnant;

        return $this;
    }

    /**
     * Get gagnant
     *
     * @return \CoreBundle\Entity\Joueur
     */
    public function getGagnant() {
        return $this->gagnant;
    }

}
