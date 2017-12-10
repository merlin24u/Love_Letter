<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CoreBundle\Entity\Deck;
use CoreBundle\Entity\DeckPossede;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeckController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction($id, Request $request) {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('CoreBundle:Deck');

            $deck = $rep->find($id);

            if ($deck != null) {
                $rep = $em->getRepository('CoreBundle:DeckPossede');
                $listeC = $rep->findBy(array('deck' => $deck));
                
                $res = array();
                
                foreach($listeC as $c){
                    $res[] = $c->getCarte()->getIdcarte();
                }
                
                return new JsonResponse(array('Cartes' => $res));
            }
        }
    }

}
