<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="taille", type="float")
     */
    private $taille;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float")
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_initiale", type="float")
     */
    private $prixInitiale;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_promo", type="float")
     */
    private $prixPromo;

    /**
     * @var float
     *
     * @ORM\Column(name="taux_reduction", type="float")
     */
    private $tauxReduction;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="date_creation", type="datetimetz")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expiration", type="datetimetz")
     */
    private $dateExpiration;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="produits")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set taille
     *
     * @param float $taille
     *
     * @return Produit
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return float
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set poids
     *
     * @param float $poids
     *
     * @return Produit
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prixInitiale
     *
     * @param float $prixInitiale
     *
     * @return Produit
     */
    public function setPrixInitiale($prixInitiale)
    {
        $this->prixInitiale = $prixInitiale;

        return $this;
    }

    /**
     * Get prixInitiale
     *
     * @return float
     */
    public function getPrixInitiale()
    {
        return $this->prixInitiale;
    }

    /**
     * Set prixPromo
     *
     * @param float $prixPromo
     *
     * @return Produit
     */
    public function setPrixPromo($prixPromo)
    {
        $this->prixPromo = $prixPromo;

        return $this;
    }

    /**
     * Get prixPromo
     *
     * @return float
     */
    public function getPrixPromo()
    {
        return $this->prixPromo;
    }

    /**
     * Set tauxReduction
     *
     * @param float $tauxReduction
     *
     * @return Produit
     */
    public function setTauxReduction($tauxReduction)
    {
        $this->tauxReduction = $tauxReduction;

        return $this;
    }

    /**
     * Get tauxReduction
     *
     * @return float
     */
    public function getTauxReduction()
    {
        return $this->tauxReduction;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateAjout
     *
     * @return Produit
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateExpiration
     *
     * @param \DateTime $dateExpiration
     *
     * @return Produit
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    /**
     * Get dateExpiration
     *
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Produit
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
}
