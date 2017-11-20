<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @ORM\Table(name="Tour", indexes={@ORM\Index(name="FKTour", columns={"nbManche", "idPartie"})})
 * @ORM\Entity
 */
class Tour
{
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
     * @ORM\ManyToOne(targetEntity="Manche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nbManche", referencedColumnName="nbManche"),
     *   @ORM\JoinColumn(name="idPartie", referencedColumnName="idPartie")
     * })
     */
    private $nbmanche;


}

