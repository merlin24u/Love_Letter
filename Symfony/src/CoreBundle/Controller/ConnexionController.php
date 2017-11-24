<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\JoueurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Joueur;

class ConnexionController extends Controller {

    public function indexAction(Request $request) {

        $joueur = new Joueur();
        
        $form = $this->createForm(JoueurType::class, $joueur);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $repository = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Joueur');

                $joueurRet = $repository->find($joueur->getLogin());

                if ($joueurRet != null) {
                    $request->getSession()->getFlashBag()->add('notice', 'Connecté');
                }

                return $this->redirectToRoute('connexion_home');
            }
        }


        return $this->render('CoreBundle:Connexion:index.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
