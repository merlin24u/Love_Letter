<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use CoreBundle\Entity\Main;
use CoreBundle\Entity\MainPossede;
use CoreBundle\Entity\Participe;
use CoreBundle\Entity\Defausse;
use CoreBundle\Entity\DefaussePossede;
use CoreBundle\Entity\Partie;
use CoreBundle\Entity\Joueur;
use CoreBundle\Entity\Carte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction($id, Request $request) {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('CoreBundle:Main');

            $main = $rep->find($id);

            if ($main != null) {
                $rep = $em->getRepository('CoreBundle:MainPossede');
                $listC = $rep->findBy(array('main' => $main));

                $res = array();

                foreach ($listC as $c) {
                    $res[] = $c->getCarte()->getIdcarte();
                }

                return new JsonResponse(array('Cartes' => $res));
            }
        }
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @ParamConverter("partie", options={"mapping": {"partie": "idpartie"}})
     * @ParamConverter("user", options={"mapping": {"user": "id"}})
     * @ParamConverter("def", options={"mapping": {"def": "iddefausse"}})
     * @ParamConverter("val", options={"mapping": {"val": "idcarte"}})
     */
    public function deleteAction($id, Carte $val, Joueur $user, Partie $partie, Defausse $def, Request $request) {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('CoreBundle:Main');

            //stocke la carte jouée
            $main = $rep->find($id);
            $main->setCartejouee($val);

            //applique effet de la carte jouee
            switch ($val->getValeur()) {
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    break;
                case 5:
                    break;
                case 6:
                    break;
                case 7:
                    break;
                case 8:
                    $rep = $em->getRepository('CoreBundle:Participe');
                    $part = $rep->findOneBy(array('idlogin' => $user, 'idpartie' => $partie));
                    $part->setElimine(true);
                    break;
            }

            if ($main != null) {
                $rep = $em->getRepository('CoreBundle:MainPossede');
                $carte = $rep->findOneBy(array('main' => $main, 'carte' => $val));
                $em->remove($carte);
                $em->flush();

                $listC = $rep->findBy(array('main' => $main));

                $res = array();

                foreach ($listC as $c) {
                    $res[] = $c->getCarte()->getIdcarte();
                }

                $rep = $em->getRepository('CoreBundle:DefaussePossede');
                $Ndef = new DefaussePossede();
                $Ndef->setCarte($val);
                $Ndef->setDefausse($def);
                $em->persist($Ndef);

                $rep = $em->getRepository('CoreBundle:Participe');
                $part = $rep->findOneBy(array('idlogin' => $user, 'idpartie' => $partie));
                $part->setToken(false);

                $rep = $em->getRepository('CoreBundle:Participe');
                $Idadversaire = $rep->adversaire($user, $partie);

                if (!empty($Idadversaire)) {
                    $user2 = $this->get('security.token_storage')->getToken()->getUser();
                    $userManager = $this->get('fos_user.user_manager');
                    $adversaire = $userManager->findUserBy(array('id' => $Idadversaire[0]->getIdlogin()));

                    $rep = $em->getRepository('CoreBundle:Participe');
                    $part = $rep->findOneBy(array('idlogin' => $adversaire, 'idpartie' => $partie));
                    $part->setToken(true);
                    $part->setPioche(true);
                }

                $em->flush();

                return new JsonResponse(array('Cartes' => $res));
            }
        }
    }

}
