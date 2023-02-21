<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\typeConsultation;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    //#[Assert\NotBlank(message:"Please add your appointement date")]
    #[Assert\GreaterThan("today")]
    private ?\DateTimeInterface $dateConsultation = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank(message:"Please add your appointement time")]
    private ?\DateTimeInterface $heureConsultation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please add your appointement type")]
    private ?string $typeConsultation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please add your appointement name")]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Expression(
        "this.getUtilisateur()!= 'NO NUTRISIONIST FOUND'",
        message: 'UNVALID! Please choose a nutritionist',
    )]
    #[Assert\NotBlank(message:"Please add your nutritionist")]
    private ?User $utilisateur = null;



    public function __construct()
    {
        $this->dateConsultation = new \DateTime();
        $this->heureConsultation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateConsultation(): ?\DateTimeInterface
    {
        return $this->dateConsultation;
    }

    public function setDateConsultation(\DateTimeInterface $dateConsultation): self
    {
        $this->dateConsultation = $dateConsultation;

        return $this;
    }

    public function getHeureConsultation(): ?\DateTimeInterface
    {
        return $this->heureConsultation;
    }

    public function setHeureConsultation(\DateTimeInterface $heureConsultation): self
    {
        $this->heureConsultation = $heureConsultation;

        return $this;
    }

    public function getTypeConsultation(): ?string
    {
        return $this->typeConsultation;
    }

    public function setTypeConsultation(string $typeConsultation): self
    {
        if (!in_array($typeConsultation, [typeConsultation::ADISTANCE, typeConsultation::CABINET])) {
            throw new \InvalidArgumentException("Invalid type value");
        }

        $this->typeConsultation = $typeConsultation;

        return $this;
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

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
    public function __toString(): string
    {
        return $this->nom;
  }
}
