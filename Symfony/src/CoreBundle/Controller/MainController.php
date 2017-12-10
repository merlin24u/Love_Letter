<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CoreBundle\Entity\Main;
use CoreBundle\Entity\MainPossede;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction($id,Request $request) {
        if ($request->isXmlHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('CoreBundle:Main');
            
            $main = $rep->find($id);
            
            if($main != null){
                $rep = $em->getRepository('CoreBundle:MainPossede'); 
                $listC = $rep->findBy(array('main' => $main));
                
                $res = array();
                
                foreach($listC as $c){
                    $res[] = $c->getCarte()->getValeur();
                }
                
                return new JsonResponse(array('Cartes' => $res));
            }
        }
    }

}
