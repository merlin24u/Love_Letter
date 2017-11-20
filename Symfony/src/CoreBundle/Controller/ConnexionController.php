<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Joueur;

class ConnexionController extends Controller
{
    public function indexAction()
    {
        $joueur = new Joueur("Joueur1");
        $joueur->setMdp("Secret");
        $joueur->setScore(-1);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($joueur);
        $em->flush();
        
        $content = $this->get('templating')->render('CoreBundle:Connexion:index.html.twig');
        return new Response($content);
    }
}

