<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manche
 *
 * @ORM\Table(name="Manche")
 * @ORM\Entity
 */
class Manche {

    /**
     * @var integer
     *
     * @ORM\Column(name="idManche", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmanche;

    /**
     * @var \Partie
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Partie", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPartie", referencedColumnName="idPartie")
     * })
     */
    private $idpartie;

    /**
     * Set idmanche
     *
     * @param integer $idmanche
     *
     * @return Manche
     */
    public function setIdmanche($idmanche) {
        $this->idmanche = $idmanche;

        return $this;
    }

    /**
     * Get idmanche
     *
     * @return integer
     */
    public function getIdmanche() {
        return $this->idmanche;
    }

    /**
     * Set idpartie
     *
     * @param \CoreBundle\Entity\Partie $idpartie
     *
     * @return Manche
     */
    public function setIdpartie(\CoreBundle\Entity\Partie $idpartie) {
        $this->idpartie = $idpartie;

        return $this;
    }

    /**
     * Get idpartie
     *
     * @return \CoreBundle\Entity\Partie
     */
    public function getIdpartie() {
        return $this->idpartie;
    }

}
