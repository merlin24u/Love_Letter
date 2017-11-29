<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Partie;
use CoreBundle\Entity\Joueur;
use CoreBundle\Entity\Participe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PartieController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction() {

        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CoreBundle:Partie');

        $listeParties = $repository->getPartieOuv();
  
        return $this->render('CoreBundle:Partie:gestionPartie.html.twig', array('tab' => $listeParties));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @ParamConverter("partie", options={"mapping": {"id": "idpartie"}})
     */
    public function partieAction(Partie $partie) {

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('CoreBundle:Participe');

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('username' => $user->getUsername()));

        $p = new Participe();
        $p->setIdpartie($partie);
        $p->setIdlogin($u);
        $p->setScore(-1);
        $p->setToken(false);
        $em->persist($p);
        $em->flush();

        return $this->render('CoreBundle:Partie:partie.html.twig', array('num' => $partie->getIdpartie(), 'o' => false));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * 
     */
    public function addAction($nb) {

        $em = $this->getDoctrine()->getManager();
        $partie = new Partie();
        $partie->setNbjoueurs($nb);
        $partie->setGagnant(null);
        $partie->setOuverte(true);

        $em->persist($partie);
        $em->flush();

        return $this->render('CoreBundle:Partie:partie.html.twig', array('num' => $partie->getIdpartie(),'o' => false));
    }

}
