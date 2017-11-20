<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Defausse
 *
 * @ORM\Table(name="Defausse", indexes={@ORM\Index(name="FKDefausse1", columns={"login"}), @ORM\Index(name="FKDefausse2", columns={"nbManche", "idPartie"})})
 * @ORM\Entity
 */
class Defausse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDefausse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $iddefausse;

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

