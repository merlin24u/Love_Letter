<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Partie;
use CoreBundle\Entity\Deck;
use CoreBundle\Entity\Main;
use CoreBundle\Entity\Manche;
use CoreBundle\Entity\Tour;
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
        $b = true;

        if (empty($listeParticipe)) {
            $liste = $listeParties;
        } else {
            foreach ($listeParties as $partie) {
                foreach ($listeParticipe as $part) {
                    if ($partie == $part->getIdpartie()) {
                        $b = false;
                        break;
                    }
                }

                if ($b) {
                    $liste[] = $partie;
                    $b = true;
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

        $p = $rep->participe($u, $partie);
        $ouv = true;

        if (empty($p)) {

            $p = new Participe();
            $p->setIdpartie($partie);
            $p->setIdlogin($u);
            $p->setScore(-1);
            $p->setToken(false);
            $em->persist($p);
            $em->flush();
        }

        $listeParties = $rep->getPartie($partie);

        if (sizeof($listeParties) == $partie->getNbjoueurs()) {
            if ($partie->getOuverte()) {
                $partie->setOuverte(false);
            }

            $ouv = false;

            $rep = $em->getRepository('CoreBundle:Manche');
            $manche = $rep->findOneBy(array('idpartie' => $partie));

            if (empty($manche)) {
                $manche = new Manche();
                $manche->setFini(false);
                $manche->setIdpartie($partie);
                $em->persist($manche);
            }

            $rep = $em->getRepository('CoreBundle:Tour');
            $tour = $rep->findOneBy(array('idmanche' => $manche));

            if (empty($tour)) {
                $tour = new Tour();
                $tour->setIdmanche($manche);
                $em->persist($tour);
            }

            $rep = $em->getRepository('CoreBundle:Deck');
            $deck = $rep->findOneBy(array('idlogin' => $u));

            if (empty($deck)) {
                $deck = new Deck();
                $deck->setIdlogin($u);
                $deck->setIdmanche($manche);
                $em->persist($deck);
            }

            $rep = $em->getRepository('CoreBundle:Deck');
            $main = $rep->findOneBy(array('idlogin' => $u));

            if (empty($main)) {
                $main = new Main();
                $main->setCartejouee(NULL);
                $main->setIdlogin($u);
                $main->setIdtour($tour);
                $em->persist($main);
            }
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

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('username' => $user->getUsername()));

        $p = new Participe();
        $p->setIdpartie($partie);
        $p->setIdlogin($u);
        $p->setScore(-1);
        $p->setToken(false);

        $em->persist($partie);
        $em->persist($p);
        $em->flush();

        return $this->render('CoreBundle:Partie:partie.html.twig', array('num' => $partie->getIdpartie(), 'o' => true, 'id' => $u));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function persoAction($id) {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('username' => $user->getUsername()));

        if ($u->getId() != $id)
            $this->redirectToRoute('accueil');

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
