<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Livre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\LivreType;
use AppBundle\Entity\Commentaire;
use AppBundle\Form\CommentaireType;
class LivreController extends Controller
{
    //--- Méthode pour récupérer et afficher tout les livres ---
    /**
     * @Rest\View(serializerGroups={"livres"})
     * @Rest\Get("/api/livre")
     */
    public function recuperationLivresAction()
    {
        $livres = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Livre')
            ->findAll();
        return $livres;
    }

    //--- Méthode pour créer un livre ---
    /**
     * @Rest\View(serializerGroups={"livres"}, statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/livre/create")
     */
    public function creationLivreAction(Request $request)
    {
        $livre = new Livre;

        $form = $this->createForm(LivreType::class, $livre);
        $form->submit($request->request->all());

        if ($form->isValid()) {

            /* Date d'ajout et de parution set à la date courante ( pour utilisation Postman ) */
            $livre->setDateAjout(new \DateTime('now'));
            $livre->setDateParution(new \DateTime('now'));

            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($livre);
            $em->flush();
            return $livre;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et afficher un livre ---
    /**
     * @Rest\View(serializerGroups={"livres"})
     * @Rest\Get("/api/livre/{id}")
     */
    public function recuperationLivreAction(Livre $livre)
    {
        return $livre;
    }

    //--- Méthode pour récupérer et éditer un livre ---
    /**
     * @Rest\View(serializerGroups={"livres"},)
     * @Rest\Patch("/api/livre/{id}/edit")
     */
    public function editLivreAction(Request $request, Livre $livre)
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            /* Date d'ajout et de parution set à la date courante ( pour utilisation Postman ) */
            $livre->setDateAjout(new \DateTime('now'));
            $livre->setDateParution(new \DateTime('now'));

            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($livre);
            $em->flush();
            return $livre;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et supprimer un livre ---
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT))
     * @Rest\Delete("/api/livre/{id}/delete")
     */
    public function deleteLivreAction(Livre $livre)
    {
        if ($livre) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($livre);
            $em->flush();
        }
    }

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
}
