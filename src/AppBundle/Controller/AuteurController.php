<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Auteur;
use AppBundle\Form\AuteurType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class AuteurController extends Controller
{
    //--- Méthode pour récupérer et afficher tout les auteurs ---
    /**
     * @Rest\View(serializerGroups={"auteur"})
     * @Rest\Get("/api/auteur")
     */
    public function recuperationAuteursAction()
    {
        $auteurs = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Auteur')
            ->findAll();
        return $auteurs;
    }

    //--- Méthode pour créer un auteur ---
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/auteur/create")
     */
    public function creationAuteurAction(Request $request)
    {
        $auteur = new Auteur;
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($auteur);
            $em->flush();
            return $auteur;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et afficher un auteur ---
    /**
     * @Rest\View(serializerGroups={"auteur"})
     * @Rest\Get("/api/auteur/{id}")
     */
    public function recuperationAuteurAction(Auteur $auteur)
    {
        return $auteur;
    }

    //--- Méthode pour récupérer et éditer un auteur ---
    /**
     * @Rest\View()
     * @Rest\Patch("/api/auteur/{id}/edit")
     */
    public function editAuteurAction(Request $request, Auteur $auteur)
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($auteur);
            $em->flush();
            return $auteur;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et supprimer un auteur ---
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT))
     * @Rest\Delete("/api/auteur/{id}/delete")
     */
    public function deleteAuteurAction(Auteur $auteur)
    {
        if ($auteur) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($auteur);
            $em->flush();
        }
    }
}
