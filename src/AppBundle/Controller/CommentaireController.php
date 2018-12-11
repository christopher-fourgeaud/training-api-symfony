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
    
    //--- Méthode pour récupérer et supprimer un commentaire ---
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT))
     * @Rest\Delete("/api/commentaire/{id}")
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
