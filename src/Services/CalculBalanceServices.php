<?php
namespace App\Services;

use App\Entity\FriendGroup;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class CalculBalanceServices{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;

    }
    public function CalculsExpenses(FriendGroup $group){

        $activities = [];
        $users = [];
        foreach ($group->getUsers() as $user){
            $users[$user->getFirstname()] = 0.0;
        }
        foreach ($group->getActivities() as $activity){
                $users[$activity->getUser()->getFirstname()] += $activity->getCost();
        }

        $totalUsers = count($group->getUsers());
        $averageExpense = array_sum($users) / $totalUsers;
        foreach ($users as $userId => $balance) {
            $owedAmount = $balance - $averageExpense;

            $users[$userId] = $owedAmount;

        }
        return $users;


    }



}