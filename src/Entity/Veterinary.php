<?php

namespace App\Entity;

use App\Repository\VeterinaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VeterinaryRepository::class)]
class Veterinary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(
        min: 10,
        max: 100,
        minMessage: '{{ limit }} caractères minimum',
        maxMessage: '{{ limit }} caractères maximum',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        max: 50,
        minMessage: '{{ limit }} caractères minimum',
        maxMessage: '{{ limit }} caractères maximum',
    )]
    private ?string $address = null;

    #[ORM\Column(length: 5)]
    #[Assert\Regex(
        pattern: "/^(0[1-9]|[1-9][0-9])[0-9]{3}$/",
        message: "Ce code postal n'existe pas"
    )] 
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 25)]
    #[Assert\Regex(
        pattern: '/^0[1-9](\.\d{2}){4}$/',
        message: " le 1er chiffre est toujours,, le second chiffre n’est jamais 0"
    )] 
    private ?string $phonep = null;

    #[ORM\Column(length: 100)]
    private ?string $imageFileName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    /**
     * @var Collection<int, Activity>
     */
    #[ORM\ManyToMany(targetEntity: Activity::class, inversedBy: 'veterinaries')]
    private Collection $activities;

    /**
     * @var Collection<int, FollowUp>
     */
    #[ORM\OneToMany(targetEntity: FollowUp::class, mappedBy: 'veterinary')]
    private Collection $followUps;

    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'veterinary')]
    private Collection $goals;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'veterinaries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;


    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->followUps = new ArrayCollection();
        $this->goals = new ArrayCollection();
        $this->creationDate = new \Datetime();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhonep(): ?string
    {
        return $this->phonep;
    }

    public function setPhonep(string $phonep): static
    {
        $this->phonep = $phonep;

        return $this;
    }

    public function getImageFileName(): ?string
    {
        return $this->imageFileName;
    }

    public function setImageFileName(string $imageFileName): static
    {
        $this->imageFileName = $imageFileName;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): static
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): static
    {
        $this->activities->removeElement($activity);

        return $this;
    }

    /**
     * @return Collection<int, FollowUp>
     */
    public function getFollowUps(): Collection
    {
        return $this->followUps;
    }

    public function addFollowUp(FollowUp $followUp): static
    {
        if (!$this->followUps->contains($followUp)) {
            $this->followUps->add($followUp);
            $followUp->setVeterinary($this);
        }

        return $this;
    }

    public function removeFollowUp(FollowUp $followUp): static
    {
        if ($this->followUps->removeElement($followUp)) {
            // set the owning side to null (unless already changed)
            if ($followUp->getVeterinary() === $this) {
                $followUp->setVeterinary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): static
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setVeterinary($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getVeterinary() === $this) {
                $goal->setVeterinary(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
    
}
