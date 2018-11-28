<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Form\CategorieType;
use AppBundle\Entity\Categorie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller
{
    //--- Méthode pour récupérer et afficher toutes les catégories ---
    /**
     * @Rest\View(serializerGroups={"categories"})
     * @Rest\Get("/api/categorie")
     */
    public function recuperationCategoriesAction()
    {
        $categories = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Categorie')
            ->findAll();
        return $categories;
    }

    //--- Méthode pour créer une catégorie ---
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/categorie/create")
     */
    public function creationCategorieAction(Request $request)
    {
        $categorie = new Categorie;
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($categorie);
            $em->flush();
            return $categorie;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et afficher une catégorie ---
    /**
     * @Rest\View(serializerGroups={"categories"})
     * @Rest\Get("/api/categorie/{id}")
     */
    public function recuperationCategorieAction(Categorie $categorie)
    {
        return $categorie;
    }

    //--- Méthode pour récupérer et éditer une catégorie ---
    /**
     * @Rest\View()
     * @Rest\Patch("/api/categorie/{id}/edit")
     */
    public function editCategorieAction(Request $request, Categorie $categorie)
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($categorie);
            $em->flush();
            return $categorie;
        }
        return new JsonResponse(['message' => 'Formulaire non valide'], Response::HTTP_NOT_FOUND);
    }

    //--- Méthode pour récupérer et supprimer une catégorie ---
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT))
     * @Rest\Delete("/api/categorie/{id}/delete")
     */
    public function deleteCategorieAction(Categorie $categorie)
    {
        if ($categorie) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($categorie);
            $em->flush();
        }
    }
}
