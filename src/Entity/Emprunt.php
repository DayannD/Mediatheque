<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpruntRepository::class)
 */
class Emprunt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_emprunt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity=Livre::class, cascade={"persist", "remove"})
     */
    private $name_livre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->date_emprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $date_emprunt): self
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    public function getEmail(): ?User
    {
        return $this->email;
    }

    public function setEmail(?User $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNameLivre(): ?Livre
    {
        return $this->name_livre;
    }

    public function setNameLivre(?Livre $name_livre): self
    {
        $this->name_livre = $name_livre;

        return $this;
    }
}
