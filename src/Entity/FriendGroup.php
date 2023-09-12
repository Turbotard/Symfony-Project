<?php

namespace App\Entity;

use App\Repository\FriendGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendGroupRepository::class)]
class FriendGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'friend_group_id')]
    private ?Activities $activities = null;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'friend_group_id')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivities(): ?Activities
    {
        return $this->activities;
    }

    public function setActivities(?Activities $activities): static
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addFriendGroupId($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeFriendGroupId($this);
        }

        return $this;
    }
}
