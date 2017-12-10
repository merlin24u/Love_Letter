<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use CoreBundle\Entity\Main;
use CoreBundle\Entity\MainPossede;
use CoreBundle\Entity\Participe;
use CoreBundle\Entity\Partie;
use CoreBundle\Entity\Joueur;
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
     */
    public function deleteAction($id, $val, Joueur $user, Partie $partie, Request $request) {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('CoreBundle:Main');

            $main = $rep->find($id);

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

                $rep = $em->getRepository('CoreBundle:Participe');
                $part = $rep->findOneBy(array('idlogin' => $user, 'idpartie' => $partie));
                $part->setToken(false);

                $em->flush();

                return new JsonResponse(array('Cartes' => $res));
            }
        }
    }

}
