<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_principal", type="string", length=255)
     */
    private $genrePrincipal;

    /**
     * @var string
     *
     * @ORM\Column(name="sous_genre", type="string", length=255)
     */
    private $sousGenre;


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
}

