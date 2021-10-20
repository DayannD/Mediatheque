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

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLoan = false;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $renderingAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $loanAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRendering;

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

    public function getIsLoan(): ?bool
    {
        return $this->isLoan;
    }

    public function setIsLoan(bool $isLoan): self
    {
        $this->isLoan = $isLoan;

        return $this;
    }
        public function getRenderingAt(): ?\DateTimeInterface
    {
        return $this->renderingAt;
    }

    public function setRenderingAt(?\DateTimeInterface $renderingAt): self
    {
        $this->renderingAt = $renderingAt;

        return $this;
    }

    public function getLoanAt(): ?\DateTimeInterface
    {
        return $this->loanAt;
    }

    public function setLoanAt(?\DateTimeInterface $loanAt): self
    {
        $this->loanAt = $loanAt;

        return $this;
    }

    public function getIsRendering(): ?bool
    {
        return $this->isRendering;
    }

    public function setIsRendering(bool $isRendering): self
    {
        $this->isRendering = $isRendering;

        return $this;
    }

}
