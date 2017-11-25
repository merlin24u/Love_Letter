<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Partie;

class PartieController extends Controller {

    public function indexAction() {
        return $this->render('CoreBundle:Partie:partie.html.twig');
    }

}
