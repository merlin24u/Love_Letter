<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Main
 *
 * @ORM\Table(name="MainPossede")
 * @ORM\Entity
 */
class MainPossede {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Main
     * 
     * @ORM\ManyToOne(targetEntity="Main", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="main", referencedColumnName="idMain")
     * })
     */
    private $main;

    /**
     * @var \Carte
     * 
     * @ORM\ManyToOne(targetEntity="Carte", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="carte", referencedColumnName="idCarte")
     * })
     */
    private $carte;

    public function getId() {
        return $this->id;
    }

    public function getCarte() {
        return $this->carte;
    }

    public function getMain() {
        return $this->main;
    }

    public function setMain($m) {
        $this->main = $m;

        return $this;
    }

    public function setCarte($c) {
        $this->carte = $c;

        return $this;
    }

}
