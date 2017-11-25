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
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @ORM\Column(name="roles", type="array", nullable = true)
     */
    private $roles = array();

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
        return $this->getMdp();
    }

    public function getRoles() {
        return $this->roles;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Joueur
     */
    public function setRoles($roles) {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt() {
        return $this->salt;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Joueur
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    public function getUsername() {
        return $this->login;
    }

}
