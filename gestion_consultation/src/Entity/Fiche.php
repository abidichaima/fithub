<?php

namespace App\Entity;

use App\Repository\FicheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Consultation;
use Symfony\Component\Validator\Constraints as Assert;
use App\Enum\caterogy;

#[ORM\Entity(repositoryClass: FicheRepository::class)]
class Fiche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please add your description")]
    private ?string $descriptionFiche = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])] 
    #[Assert\NotNull()]
    #[Assert\NotBlank(message:"Please add your consultation")]
    private ?Consultation $consultation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please add your fiche name")]
    private ?string $nomFiche = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please add your category")]
    private ?string $category = null;

    public function __toString(){
        return 'whatever you neet to see the type';
  }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionFiche(): ?string
    {
        return $this->descriptionFiche;
    }

    public function setDescriptionFiche(string $descriptionFiche): self
    {
        $this->descriptionFiche = $descriptionFiche;

        return $this;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setConsultation(?Consultation $consultation): self
    {
        $this->consultation = $consultation;

        return $this;
    }

    public function getNomFiche(): ?string
    {
        return $this->nomFiche;
    }

    public function setNomFiche(string $nomFiche): self
    {
        $this->nomFiche = $nomFiche;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $caterogy): self
    {
        if (!in_array($caterogy, [caterogy::NEW, caterogy::FOLLOWUP])) {
            throw new \InvalidArgumentException("Invalid type value");
        }

        $this->category = $caterogy;

        return $this;
    }
}
