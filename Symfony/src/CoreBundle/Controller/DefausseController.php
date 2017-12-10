<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CoreBundle\Entity\Defausse;
use CoreBundle\Entity\DefaussePossede;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefausseController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction($id, Request $request) {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('CoreBundle:Defausse');

            $defausse = $rep->find($id);

            if ($defausse != null) {
                $rep = $em->getRepository('CoreBundle:DefaussePossede');

                $listC = $rep->findBy(array('defausse' => $defausse));

                $res = array();

                foreach ($listC as $c) {
                    $res[] = $c->getCarte()->getValeur();
                }

                return new JsonResponse(array('Cartes' => $res));
            }
        }
    }

}
