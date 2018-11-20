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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/test")
     */
    public function recuperationAuteursAction()
    {
        $aut = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Auteur')
            ->findAll();
            return $aut;
    }

    /**
     * @Rest\View(serializerGroups={"auteur"})
     * @Rest\Get("/api/test/{id}")
     */
    public function recuperationAuteurAction(Auteur $auteur)
    {
        return $auteur;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/test")
     */
    public function creationAuteurAction(Request $request)
    {
        $auteur = New Auteur;
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

    /**
     * @Rest\View()
     * @Rest\Patch("/api/test/{id}")
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

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT))
     * @Rest\Delete("/api/test/{id}")
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
