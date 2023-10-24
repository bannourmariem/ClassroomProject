<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'etudiants')]
    private ?self $classroom = null;

    #[ORM\OneToMany(mappedBy: 'classroom', targetEntity: self::class)]
    #[ORM\JoinColumn(name:'nc_id',referencedColumnName:'ref')]

    private Collection $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getClassroom(): ?self
    {
        return $this->classroom;
    }

    public function setClassroom(?self $classroom): static
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Collection<int, self>
     
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(self $etudiant): static
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants->add($etudiant);
            $etudiant->setClassroom($this);
        }

        return $this;
    }     
 
    public function removeEtudiant(self $etudiant): static
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getClassroom() === $this) {
                $etudiant->setClassroom(null);
            }
        }

        return $this;
    }


    //il faut ajouter cette methode 
    public function __toString(){
        return $this->name;
    }

}
