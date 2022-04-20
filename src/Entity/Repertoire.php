<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert; Pour gérer les contraintes validation a voir après

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepertoireRepository")
 */
class Repertoire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomRep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoRep;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoRep;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRep(): ?string
    {
        return $this->nomRep;
    }

    public function setNomRep(string $nomRep): self
    {
        $this->nomRep = $nomRep;

        return $this;
    }

    public function getLogoRep(): ?string
    {
        return $this->logoRep;
    }

    public function setLogoRep(string $logoRep): self
    {
        $this->logoRep = $logoRep;

        return $this;
    }

    public function getInfoRep(): ?string
    {
        return $this->infoRep;
    }

    public function setInfoRep(?string $infoRep): self
    {
        $this->infoRep = $infoRep;

        return $this;
    }
}
