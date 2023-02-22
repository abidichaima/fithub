<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreVideo = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionVideo = null;

    #[ORM\Column(length: 255)]
    private ?string $fileUrlVideo = null;

    #[Assert\NotBlank(message:"Merci de choisir un video")]
    #[Assert\File(maxSize: '3072M', mimeTypes: ['video/mp4'])]
    private $uploaded_video;


    public function getUploadedVideo()
    {
        return $this->uploaded_video;
    }

    public function setUploadedVideo($uploaded_video): self
    {
        $this->uploaded_video = $uploaded_video;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreVideo(): ?string
    {
        return $this->titreVideo;
    }

    public function setTitreVideo(string $titreVideo): self
    {
        $this->titreVideo = $titreVideo;

        return $this;
    }

    public function getDescriptionVideo(): ?string
    {
        return $this->descriptionVideo;
    }

    public function setDescriptionVideo(string $descriptionVideo): self
    {
        $this->descriptionVideo = $descriptionVideo;

        return $this;
    }

    public function getFileUrlVideo(): ?string
    {
        return $this->fileUrlVideo;
    }

    public function setFileUrlVideo(string $fileUrlVideo): self
    {
        $this->fileUrlVideo = $fileUrlVideo;

        return $this;
    }


}
