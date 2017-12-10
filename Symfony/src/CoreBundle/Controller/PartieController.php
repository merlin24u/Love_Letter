<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Partie;
use CoreBundle\Entity\Deck;
use CoreBundle\Entity\DeckPossede;
use CoreBundle\Entity\Defausse;
use CoreBundle\Entity\DefaussePossede;
use CoreBundle\Entity\Main;
use CoreBundle\Entity\MainPossede;
use CoreBundle\Entity\Manche;
use CoreBundle\Entity\Tour;
use CoreBundle\Entity\Joueur;
use CoreBundle\Entity\Carte;
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

        //Acces à une partie
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('CoreBundle:Participe');

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $u = $userManager->findUserBy(array('username' => $user->getUsername()));

        $p = $rep->findOneBy(array('idpartie' => $partie, 'idlogin' => $u));
        $ouv = true;

        if ($p == null) {

            $p = new Participe();
            $p->setIdpartie($partie);
            $p->setIdlogin($u);
            $p->setScore(0);
            $p->setToken(false);
            $em->persist($p);
            $em->flush();
        }

        //token pour savoir si c'est au tour du joueur 
        $token = $p->getToken();

        $listeParties = $rep->getPartie($partie);

        if (sizeof($listeParties) == $partie->getNbjoueurs()) {
            if ($partie->getOuverte()) {
                $partie->setOuverte(false);

                //donne le jeton au joueur qui lance la partie
                $p->setToken(true);
                $token = true;
            }

            $ouv = false;

            $rep = $em->getRepository('CoreBundle:Manche');
            $manche = $rep->findBy(array('idpartie' => $partie));

            if (empty($manche)) {
                $manche = new Manche();
                $manche->setFini(false);
                $manche->setIdpartie($partie);
                $em->persist($manche);
            } else {
                $manche = $manche[sizeof($manche) - 1];
            }

            $rep = $em->getRepository('CoreBundle:Tour');
            $tour = $rep->findBy(array('idmanche' => $manche));

            if (empty($tour)) {
                $tour = new Tour();
                $tour->setIdmanche($manche);
                $em->persist($tour);
            } else {
                $tour = $tour[sizeof($tour) - 1];
            }

            $em->flush();

            $rep = $em->getRepository('CoreBundle:Deck');
            $deck = $rep->findOneBy(array('idlogin' => $u, 'idmanche' => $manche));

            if (empty($deck)) {
                $deck = new Deck();
                $deck->setIdlogin($u);
                $deck->setIdmanche($manche);
                $em->persist($deck);

                $tmp = array();

                for ($i = 0; $i < 16; $i++) {
                    $indice = rand(1, 8);
                    $bol = true;
                    while ($bol) {
                        if (!\array_key_exists($indice, $tmp)) {
                            $tmp[$indice] = 1;
                            $bol = false;
                        } else {
                            if ($tmp[$indice] != 2) {
                                $tmp[$indice] ++;
                                $bol = false;
                            } else
                                $indice = rand(1, 8);
                        }
                    }

                    $repCarte = $em->getRepository('CoreBundle:Carte');
                    $carte = $repCarte->find($indice);

                    $rep = $em->getRepository('CoreBundle:DeckPossede');
                    $deckp = new DeckPossede();
                    $deckp->setDeck($deck);
                    $deckp->setCarte($carte);
                    $em->persist($deckp);
                }
            }

            $em->flush();

            $rep = $em->getRepository('CoreBundle:Defausse');
            $defausse = $rep->findOneBy(array('idlogin' => $u, 'idmanche' => $manche));

            if (empty($defausse)) {
                $defausse = new Defausse();
                $defausse->setIdlogin($u);
                $defausse->setIdmanche($manche);
                $em->persist($defausse);

                $rep = $em->getRepository('CoreBundle:DeckPossede');
                $carteD = $rep->findBy(array('deck' => $deck));

                $rep = $em->getRepository('CoreBundle:DefaussePossede');
                $defausseP = new DefaussePossede();
                $defausseP->setCarte($carteD[sizeof($carteD) - 1]->getCarte());
                $defausseP->setDefausse($defausse);
                $em->persist($defausseP);
                $em->remove($carteD[sizeof($carteD) - 1]);
            }

            $em->flush();

            $rep = $em->getRepository('CoreBundle:Main');
            $main = $rep->findOneBy(array('idlogin' => $u, 'idtour' => $tour));

            if (empty($main)) {
                $main = new Main();
                $main->setCartejouee(NULL);
                $main->setIdlogin($u);
                $main->setIdtour($tour);
                $em->persist($main);

                $rep = $em->getRepository('CoreBundle:DeckPossede');
                $carteD = $rep->findBy(array('deck' => $deck));

                $rep = $em->getRepository('CoreBundle:MainPossede');
                $mainP = new MainPossede();
                $mainP->setMain($main);
                $mainP->setCarte($carteD[sizeof($carteD) - 1]->getCarte());
                $em->persist($mainP);
                $em->remove($carteD[sizeof($carteD) - 1]);
            }
        }

        $em->flush();

        //récupére defausse de l'adversaire
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('CoreBundle:Participe');

        $adversaire = $rep->adversaire($u, $partie);

        if ($adversaire != null) {
            $rep = $em->getRepository('CoreBundle:Defausse');
            $defausse2 = $rep->findOneBy(array('idlogin' => $adversaire, 'idmanche' => $manche));
        } else
            $defausse2 = null;

        return $this->render('CoreBundle:Partie:partie.html.twig', array('num' => $partie->getIdpartie(), 'o' => $ouv, 'id' => $u, 'deck' => $deck, 'hand' => $main,
                    'def' => $defausse, 'def2' => $defausse2, 'token' => $token));
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
