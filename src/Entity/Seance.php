<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Merci de choisir le titre")]
    private ?string $titreSeance = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Merci de choisir la description")]
    private ?string $descriptionSeance = null;


    #[ORM\Column]
    #[Assert\NotBlank(message:"Merci de le nombre")]
    private ?int $nbParticipantSeance = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"Merci de choisir date_debut")]
    private ?\DateTimeInterface $dateDebutSeance = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"Merci de choisir date_fin")]
    private ?\DateTimeInterface $dateFinSeance = null;




    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: ParticipationSeance::class)]
    private Collection $participant;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[Assert\NotBlank(message:"Merci de choisir coach")]
    private ?User $coach = null;



    public function __construct()
    {

        $this->video = new ArrayCollection();
        $this->participationSeances = new ArrayCollection();
        $this->participant = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreSeance(): ?string
    {
        return $this->titreSeance;
    }

    public function setTitreSeance(string $titreSeance): self
    {
        $this->titreSeance = $titreSeance;

        return $this;
    }

    public function getDescriptionSeance(): ?string
    {
        return $this->descriptionSeance;
    }

    public function setDescriptionSeance(string $descriptionSeance): self
    {
        $this->descriptionSeance = $descriptionSeance;

        return $this;
    }

    public function getNbParticipantSeance(): ?int
    {
        return $this->nbParticipantSeance;
    }

    public function setNbParticipantSeance(int $nbParticipantSeance): self
    {
        $this->nbParticipantSeance = $nbParticipantSeance;

        return $this;
    }

    public function getDateDebutSeance(): ?\DateTimeInterface
    {
        return $this->dateDebutSeance;
    }

    public function setDateDebutSeance(\DateTimeInterface $dateDebutSeance): self
    {
        $this->dateDebutSeance = $dateDebutSeance;

        return $this;
    }

    public function getDateFinSeance(): ?\DateTimeInterface
    {
        return $this->dateFinSeance;
    }

    public function setDateFinSeance(\DateTimeInterface $dateFinSeance): self
    {
        $this->dateFinSeance = $dateFinSeance;

        return $this;
    }


    /**
     * @return Collection<int, Video>
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video->add($video);
            $video->setSeance($this);
        }


        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->video->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getSeance() === $this) {
                $video->setSeance(null);
            }
        }

        return $this;
    }




    /**
     * @return Collection<int, ParticipationSeance>
     */
    public function getParticipationSeances(): Collection
    {
        return $this->participationSeances;
    }

    public function addParticipationSeance(ParticipationSeance $participationSeance): self
    {
        if (!$this->participationSeances->contains($participationSeance)) {
            $this->participationSeances->add($participationSeance);
            $participationSeance->setSeance($this);
        }

        return $this;
    }

    public function removeParticipationSeance(ParticipationSeance $participationSeance): self
    {
        if ($this->participationSeances->removeElement($participationSeance)) {
            // set the owning side to null (unless already changed)
            if ($participationSeance->getSeance() === $this) {
                $participationSeance->setSeance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParticipationSeance>
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(ParticipationSeance $participant): self
    {
        if (!$this->participant->contains($participant)) {
            $this->participant->add($participant);
            $participant->setSeance($this);
        }

        return $this;
    }

    public function removeParticipant(ParticipationSeance $participant): self
    {
        if ($this->participant->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getSeance() === $this) {
                $participant->setSeance(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->titreSeance;
    }

    public function getCoach(): ?User
    {
        return $this->coach;
    }

    public function setCoach(?User $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getNumberOfParticipationsForUser(User $user): int
    {
        $count = 0;
        foreach ($this->getParticipant() as $participation) {
            if ($participation->getUser() === $user) {
                $count++;
            }
        }
        return $count;
    }

}
