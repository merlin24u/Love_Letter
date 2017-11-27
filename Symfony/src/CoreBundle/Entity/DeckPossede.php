<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deck
 *
 * @ORM\Table(name="DeckPossede")
 * @ORM\Entity
 */
class DeckPossede {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Deck
     *
     * @ORM\OneToOne(targetEntity="Deck", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deck", referencedColumnName="idDeck")
     * })
     */
    private $deck;

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

    public function getDeck() {
        return $this->deck;
    }

    public function setDeck($d) {
        $this->deck = $d;

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
