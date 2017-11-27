<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @ORM\Table(name="Tour")
 * @ORM\Entity
 */
class Tour {

    /**
     * @var integer
     *
     * @ORM\Column(name="idTour", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtour;

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
     * Get idtour
     *
     * @return integer
     */
    public function getIdtour() {
        return $this->idtour;
    }

    /**
     * Set idmanche
     *
     * @param \CoreBundle\Entity\Manche $idmanche
     *
     * @return Tour
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
