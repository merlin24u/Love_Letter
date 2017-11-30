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

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('username' => $user->getUsername()));

        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CoreBundle:Participe');

        $listeParticipe = $repository->getParticipe($u);

        $liste = array();

        if (empty($listeParticipe)) {
            $liste = $listeParties;
        } else {
            foreach ($listeParties as $partie) {
                foreach ($listeParticipe as $part) {
                    if ($partie != $part->getIdpartie()) {
                        $liste[] = $partie;
                    }
                }
            }
        }

        return $this->render('CoreBundle:Partie:gestionPartie.html.twig', array('tab' => $liste, 'id' => $u->getId()));
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

        $p = $rep->findOneBy(array('idlogin' => $u));
        $ouv = true;

        if ($p == null) {

            $p = new Participe();
            $p->setIdpartie($partie);
            $p->setIdlogin($u);
            $p->setScore(-1);
            $p->setToken(false);
            $em->persist($p);
        }

        $listeParties = $rep->getPartie($partie);

        if (sizeof($listeParties) == $partie->getNbjoueurs()) {
            $partie->setOuverte(false);
            $ouv = false;
        }

        $em->flush();


        return $this->render('CoreBundle:Partie:partie.html.twig', array('num' => $partie->getIdpartie(), 'o' => $ouv, 'id' => $u));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction($nb) {

        $em = $this->getDoctrine()->getManager();
        $partie = new Partie();
        $partie->setNbjoueurs($nb);
        $partie->setGagnant(null);
        $partie->setOuverte(true);

        $em->persist($partie);
        $em->flush();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('username' => $user->getUsername()));

        return $this->render('CoreBundle:Partie:partie.html.twig', array('num' => $partie->getIdpartie(), 'o' => false, 'id' => $u));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function persoAction($id) {

        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('id' => $id));

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('CoreBundle:Participe');

        $listeParties = $rep->findBy(array('idlogin' => $u));

        $liste = array();

        foreach ($listeParties as $partie) {
            $liste[] = $partie->getIdpartie();
        }

        return $this->render('CoreBundle:Partie:partiePerso.html.twig', array('tab' => $liste));
    }

}
