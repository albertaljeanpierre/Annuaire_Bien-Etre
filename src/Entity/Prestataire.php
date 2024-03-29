<?php

namespace App\Entity;

use App\Repository\PrestataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestataireRepository::class)]
class Prestataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteInternet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numTel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numTVA = null;

    #[ORM\OneToOne(mappedBy: 'prestataire', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'prestataires', )]
    private Collection $categorie;

    #[ORM\OneToMany(mappedBy: 'prestataire', targetEntity: Image::class)]
    private Collection $logo;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->logo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->siteInternet;
    }

    public function setSiteInternet(string $siteInternet): self
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getNumTVA(): ?string
    {
        return $this->numTVA;
    }

    public function setNumTVA(string $numTVA): self
    {
        $this->numTVA = $numTVA;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        // set the owning side of the relation if necessary
        if ($user->getPrestataire() !== $this) {
            $user->setPrestataire($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }


    public function __toString(): string
    {
         return $this->getCategorie();
    }

    /**
     * @return Collection<int, Image>
     */
    public function getLogo(): Collection
    {
        return $this->logo;
    }

    public function addLogo(Image $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo->add($logo);
            $logo->setPrestataire($this);
        }

        return $this;
    }

    public function removeLogo(Image $logo): self
    {
        if ($this->logo->removeElement($logo)) {
            // set the owning side to null (unless already changed)
            if ($logo->getPrestataire() === $this) {
                $logo->setPrestataire(null);
            }
        }

        return $this;
    }
}
