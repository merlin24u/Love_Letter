<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Form\JoueurType;
use CoreBundle\Entity\Joueur;

class InscriptionController extends Controller {

    public function indexAction(Request $request) {

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


        return $this->render('CoreBundle:Inscription:inscription.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
