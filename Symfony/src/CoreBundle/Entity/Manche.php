<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manche
 *
 * @ORM\Table(name="Manche", indexes={@ORM\Index(name="FKManche", columns={"idPartie"})})
 * @ORM\Entity
 */
class Manche
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nbManche", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nbmanche;

    /**
     * @var \Partie
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPartie", referencedColumnName="idPartie")
     * })
     */
    private $idpartie;



    /**
     * Set nbmanche
     *
     * @param integer $nbmanche
     *
     * @return Manche
     */
    public function setNbmanche($nbmanche)
    {
        $this->nbmanche = $nbmanche;

        return $this;
    }

    /**
     * Get nbmanche
     *
     * @return integer
     */
    public function getNbmanche()
    {
        return $this->nbmanche;
    }

    /**
     * Set idpartie
     *
     * @param \CoreBundle\Entity\Partie $idpartie
     *
     * @return Manche
     */
    public function setIdpartie(\CoreBundle\Entity\Partie $idpartie)
    {
        $this->idpartie = $idpartie;

        return $this;
    }

    /**
     * Get idpartie
     *
     * @return \CoreBundle\Entity\Partie
     */
    public function getIdpartie()
    {
        return $this->idpartie;
    }
}
