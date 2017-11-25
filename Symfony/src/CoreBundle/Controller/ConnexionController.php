<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\JoueurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Joueur;

class ConnexionController extends Controller {

    public function logAction(Request $request) {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('partie');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('CoreBundle:Connexion:connexion.html.twig', array(
                    'last_username' => $authenticationUtils->getLastUsername(),
                    'error' => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function signAction(Request $request) {
        $joueur = new Joueur();

        $form = $this->createForm(JoueurType::class, $joueur);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($joueur);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Inscrit');

                return $this->redirectToRoute('connexion_home');
            }
        }


        return $this->render('CoreBundle:Connexion:inscription.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
