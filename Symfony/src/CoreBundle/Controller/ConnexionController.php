<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConnexionController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('CoreBundle:Connexion:index.html.twig');
        return new Response($content);
    }
}

