<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Main
 *
 * @ORM\Table(name="Main", indexes={@ORM\Index(name="FKMain1", columns={"login"}), @ORM\Index(name="FKMain2", columns={"idTour", "nbManche", "idPartie"}), @ORM\Index(name="IDX_1F1A625A192CA7F7", columns={"idTour"})})
 * @ORM\Entity
 */
class Main
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMain", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idmain;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbManche", type="integer", nullable=false)
     */
    private $nbmanche;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPartie", type="integer", nullable=false)
     */
    private $idpartie;

    /**
     * @var string
     *
     * @ORM\Column(name="carteJouee", type="string", length=20, nullable=true)
     */
    private $cartejouee;

    /**
     * @var \Joueur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="login", referencedColumnName="login")
     * })
     */
    private $login;

    /**
     * @var \Tour
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTour", referencedColumnName="idTour")
     * })
     */
    private $idtour;


}

