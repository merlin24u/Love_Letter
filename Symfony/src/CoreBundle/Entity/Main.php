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



    /**
     * Set idmain
     *
     * @param integer $idmain
     *
     * @return Main
     */
    public function setIdmain($idmain)
    {
        $this->idmain = $idmain;

        return $this;
    }

    /**
     * Get idmain
     *
     * @return integer
     */
    public function getIdmain()
    {
        return $this->idmain;
    }

    /**
     * Set nbmanche
     *
     * @param integer $nbmanche
     *
     * @return Main
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
     * @param integer $idpartie
     *
     * @return Main
     */
    public function setIdpartie($idpartie)
    {
        $this->idpartie = $idpartie;

        return $this;
    }

    /**
     * Get idpartie
     *
     * @return integer
     */
    public function getIdpartie()
    {
        return $this->idpartie;
    }

    /**
     * Set cartejouee
     *
     * @param string $cartejouee
     *
     * @return Main
     */
    public function setCartejouee($cartejouee)
    {
        $this->cartejouee = $cartejouee;

        return $this;
    }

    /**
     * Get cartejouee
     *
     * @return string
     */
    public function getCartejouee()
    {
        return $this->cartejouee;
    }

    /**
     * Set login
     *
     * @param \CoreBundle\Entity\Joueur $login
     *
     * @return Main
     */
    public function setLogin(\CoreBundle\Entity\Joueur $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return \CoreBundle\Entity\Joueur
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set idtour
     *
     * @param \CoreBundle\Entity\Tour $idtour
     *
     * @return Main
     */
    public function setIdtour(\CoreBundle\Entity\Tour $idtour)
    {
        $this->idtour = $idtour;

        return $this;
    }

    /**
     * Get idtour
     *
     * @return \CoreBundle\Entity\Tour
     */
    public function getIdtour()
    {
        return $this->idtour;
    }
}
