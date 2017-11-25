<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Defausse
 *
 * @ORM\Table(name="Defausse")
 * @ORM\Entity
 */
class Defausse {

    /**
     * @var integer
     *
     * @ORM\Column(name="idDefausse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddefausse;

    /**
     * @var \Joueur
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Joueur", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="login", referencedColumnName="login")
     * })
     */
    private $login;

    /**
     * @var \Manche
     *
     * @ORM\ManyToOne(targetEntity="Manche", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idManche", referencedColumnName="idManche")
     * })
     */
    private $idmanche;

    /**
     * Set iddefausse
     *
     * @param integer $iddefausse
     *
     * @return Defausse
     */
    public function setIddefausse($iddefausse) {
        $this->iddefausse = $iddefausse;

        return $this;
    }

    /**
     * Get iddefausse
     *
     * @return integer
     */
    public function getIddefausse() {
        return $this->iddefausse;
    }

    /**
     * Set login
     *
     * @param \CoreBundle\Entity\Joueur $login
     *
     * @return Defausse
     */
    public function setLogin(\CoreBundle\Entity\Joueur $login) {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return \CoreBundle\Entity\Joueur
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set idmanche
     *
     * @param \CoreBundle\Entity\Manche $idmanche
     *
     * @return Defausse
     */
    public function setIdmanche(\CoreBundle\Entity\Manche $idmanche = null) {
        $this->idmanche = $idmanche;

        return $this;
    }

    /**
     * Get idmanche
     *
     * @return \CoreBundle\Entity\Manche
     */
    public function getIdmanche() {
        return $this->idmanche;
    }
    
}
