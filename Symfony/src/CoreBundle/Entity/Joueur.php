<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Joueur
 *
 * @ORM\Table(name="Joueur")
 * @ORM\Entity
 */
class Joueur implements UserInterface {

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=true)
     */
    private $mdp;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

    public function __construct() {
        $this->score = -1;
    }

    /**
     * Set login
     * 
     * @param string $lg
     */
    public function setLogin($lg) {
        $this->login = $lg;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Joueur
     */
    public function setMdp($mdp) {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp() {
        return $this->mdp;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Joueur
     */
    public function setScore($score) {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore() {
        return $this->score;
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        
    }

    public function getRoles() {
        
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        
    }

}
