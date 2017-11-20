<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partie
 *
 * @ORM\Table(name="Partie", indexes={@ORM\Index(name="FKPartie", columns={"gagnant"})})
 * @ORM\Entity
 */
class Partie
{
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
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gagnant", referencedColumnName="login")
     * })
     */
    private $gagnant;


}

