<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Repertoire;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
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
    private $nomContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomContact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoContact;

    /**
     * @ORM\ManyToOne(targetEntity=Repertoire::class)
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idRep;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): self
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenomContact;
    }

    public function setPrenomContact(?string $prenomContact): self
    {
        $this->prenomContact = $prenomContact;

        return $this;
    }

    public function getTelContact(): ?string
    {
        return $this->telContact;
    }

    public function setTelContact(string $telContact): self
    {
        $this->telContact = $telContact;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(?string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getInfoContact(): ?string
    {
        return $this->infoContact;
    }

    public function setInfoContact(?string $infoContact): self
    {
        $this->infoContact = $infoContact;

        return $this;
    }

    public function getIdRep(): ?int
    {
        return $this->idRep;
    }

    public function setIdRep(int $idRep): self
    {
        $this->idRep = $idRep;

        return $this;
    }
}
