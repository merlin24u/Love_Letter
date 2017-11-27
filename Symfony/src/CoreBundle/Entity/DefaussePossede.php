<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deck
 *
 * @ORM\Table(name="DefaussePossede")
 * @ORM\Entity
 */
class DefaussePossede {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Defausse
     *
     * @ORM\OneToOne(targetEntity="Defausse", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="defausse", referencedColumnName="idDefausse")
     * })
     */
    private $defausse;

    /**
     * @var \Carte
     *
     * @ORM\OneToOne(targetEntity="Carte", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="carte", referencedColumnName="idCarte")
     * })
     */
    private $carte;

    public function getId() {
        return $this->id;
    }

    public function getDefausse() {
        return $this->defausse;
    }

    public function setDefausse($def) {
        $this->defausse = $def;

        return $this;
    }

    public function getCarte() {
        return $this->carte;
    }

    public function setCarte($c) {
        $this->carte = $c;

        return $this;
    }

}
