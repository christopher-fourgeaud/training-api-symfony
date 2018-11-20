<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Livre
 *
 * @ORM\Table(name="liv_livre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LivreRepository")
 */
class Livre
{
    /**
     * @var int
     *
     * @ORM\Column(name="liv_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="liv_titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="liv_date_parution", type="date")
     */
    private $dateParution;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="liv_date_ajout", type="date")
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="liv_photo", type="string", length=255)
     */
    private $photo;

    //--- DEBUT ASSOCIATION RELATIONNELLE ---

    /**
     * Plusieurs livres ont une categorie.
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="livres")
     * @ORM\JoinColumn(name="cat_categorie", referencedColumnName="cat_oid")
     */
    private $categorie;

    /**
     * Plusieurs livres ont un auteur.
     * @ORM\ManyToOne(targetEntity="Auteur", inversedBy="livres")
     * @ORM\JoinColumn(name="aut_auteur", referencedColumnName="aut_oid")
     */
    private $auteur;

    /**
     * Un livre à plusieurs commentaires.
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="livre")
     */
    private $commentaires;

    //--- FIN ASSOCIATION RELATIONNELLE ---

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateParution
     *
     * @param \DateTime $dateParution
     *
     * @return Livre
     */
    public function setDateParution($dateParution)
    {
        $this->dateParution = $dateParution;

        return $this;
    }

    /**
     * Get dateParution
     *
     * @return \DateTime
     */
    public function getDateParution()
    {
        return $this->dateParution;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Livre
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Livre
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Livre
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set auteur
     *
     * @param \AppBundle\Entity\Auteur $auteur
     *
     * @return Livre
     */
    public function setAuteur(\AppBundle\Entity\Auteur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \AppBundle\Entity\Auteur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     *
     * @return Livre
     */
    public function addCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
