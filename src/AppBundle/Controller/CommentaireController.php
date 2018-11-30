<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Livre;
use AppBundle\Entity\Commentaire;
use AppBundle\Form\CommentaireType;

class CommentaireController extends Controller
{
    //--- Méthode pour créer un commentaire sur la page du livre affiché ---
    /**
     * @Rest\View(serializerGroups={"livres"}, statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/livre/{id}")
     */
    public function creationCommentaireAction(Request $request, Livre $livre)
    {
        $commentaire = new Commentaire;

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            /* Date d'ajout set à la date courante */
            $commentaire->setDate(new \DateTime('now'));

            /* Set le commentaire sur le livre affiché en cours */
            $commentaire->setLivre($livre);

            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($commentaire);
            $em->flush();
            return $livre;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et supprimer un commentaire ---
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT))
     * @Rest\Delete("/api/commentaire/{id}/delete")
     */
    public function deleteCommentaireAction(Commentaire $commentaire)
    {
        if ($commentaire) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($commentaire);
            $em->flush();
        }
    }
}
