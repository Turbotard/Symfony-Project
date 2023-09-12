<?php

namespace App\Entity;

use App\Repository\ActivitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitiesRepository::class)]
class Activities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $cost = null;

    #[ORM\OneToMany(mappedBy: 'activities', targetEntity: FriendGroup::class)]
    private Collection $friend_group_id;

    public function __construct()
    {
        $this->friend_group_id = new ArrayCollection();
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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return Collection<int, FriendGroup>
     */
    public function getFriendGroupId(): Collection
    {
        return $this->friend_group_id;
    }

    public function addFriendGroupId(FriendGroup $friendGroupId): static
    {
        if (!$this->friend_group_id->contains($friendGroupId)) {
            $this->friend_group_id->add($friendGroupId);
            $friendGroupId->setActivities($this);
        }

        return $this;
    }

    public function removeFriendGroupId(FriendGroup $friendGroupId): static
    {
        if ($this->friend_group_id->removeElement($friendGroupId)) {
            // set the owning side to null (unless already changed)
            if ($friendGroupId->getActivities() === $this) {
                $friendGroupId->setActivities(null);
            }
        }

        return $this;
    }
}
