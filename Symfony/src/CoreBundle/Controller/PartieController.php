<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Partie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PartieController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction() {
        return $this->render('CoreBundle:Partie:partie.html.twig');
    }

}
