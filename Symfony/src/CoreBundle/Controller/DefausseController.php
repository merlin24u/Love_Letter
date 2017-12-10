<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefausseController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            
        }
    }

}
