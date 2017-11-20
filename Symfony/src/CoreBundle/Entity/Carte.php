<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carte
 *
 * @ORM\Table(name="Carte")
 * @ORM\Entity
 */
class Carte
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

