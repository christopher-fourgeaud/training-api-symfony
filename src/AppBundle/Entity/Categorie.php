<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie
 *
 * @ORM\Table(name="cat_categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="cat_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_genre_principal", type="string", length=255)
     */
    private $genrePrincipal;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_sous_genre", type="string", length=255)
     */
    private $sousGenre;

    //--- DEBUT ASSOCIATION RELATIONNELLE ---

    /**
     * Une catégorie contient plusieurs livres.
     * @ORM\OneToMany(targetEntity="Livre", mappedBy="categorie")
     */
    private $livres;

    //--- FIN ASSOCIATION RELATIONNELLE ---

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set genrePrincipal
     *
     * @param string $genrePrincipal
     *
     * @return Categorie
     */
    public function setGenrePrincipal($genrePrincipal)
    {
        $this->genrePrincipal = $genrePrincipal;

        return $this;
    }

    /**
     * Get genrePrincipal
     *
     * @return string
     */
    public function getGenrePrincipal()
    {
        return $this->genrePrincipal;
    }

    /**
     * Set sousGenre
     *
     * @param string $sousGenre
     *
     * @return Categorie
     */
    public function setSousGenre($sousGenre)
    {
        $this->sousGenre = $sousGenre;

        return $this;
    }

    /**
     * Get sousGenre
     *
     * @return string
     */
    public function getSousGenre()
    {
        return $this->sousGenre;
    }

    /**
     * Add livre
     *
     * @param \AppBundle\Entity\Livre $livre
     *
     * @return Categorie
     */
    public function addLivre(\AppBundle\Entity\Livre $livre)
    {
        $this->livres[] = $livre;

        return $this;
    }

    /**
     * Remove livre
     *
     * @param \AppBundle\Entity\Livre $livre
     */
    public function removeLivre(\AppBundle\Entity\Livre $livre)
    {
        $this->livres->removeElement($livre);
    }

    /**
     * Get livres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLivres()
    {
        return $this->livres;
    }
}
