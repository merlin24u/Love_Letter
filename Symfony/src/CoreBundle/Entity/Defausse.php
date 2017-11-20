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



    /**
     * Set iddefausse
     *
     * @param integer $iddefausse
     *
     * @return Defausse
     */
    public function setIddefausse($iddefausse)
    {
        $this->iddefausse = $iddefausse;

        return $this;
    }

    /**
     * Get iddefausse
     *
     * @return integer
     */
    public function getIddefausse()
    {
        return $this->iddefausse;
    }

    /**
     * Set login
     *
     * @param \CoreBundle\Entity\Joueur $login
     *
     * @return Defausse
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
     * Set nbmanche
     *
     * @param \CoreBundle\Entity\Manche $nbmanche
     *
     * @return Defausse
     */
    public function setNbmanche(\CoreBundle\Entity\Manche $nbmanche = null)
    {
        $this->nbmanche = $nbmanche;

        return $this;
    }

    /**
     * Get nbmanche
     *
     * @return \CoreBundle\Entity\Manche
     */
    public function getNbmanche()
    {
        return $this->nbmanche;
    }
}
