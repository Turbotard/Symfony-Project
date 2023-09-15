<?php

namespace App\Controller;

use App\Entity\FriendGroup;
use App\Entity\User;
use App\Services\CalculBalanceServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CalculController extends AbstractController
{
    private $entityManager;
    private CalculBalanceServices $calculBalanceServices;

    public function __construct(EntityManagerInterface $entityManager, CalculBalanceServices $calculBalanceServices){
        $this->entityManager = $entityManager;

        $this->calculBalanceServices = $calculBalanceServices;
    }

    #[Route('/calcul/{id}', name: 'app_calcul')]
    public function index($id): Response
    {
        $entityManager = $this->entityManager->getRepository(FriendGroup::class);
        $friendGroup = $entityManager->findOneById($id);

        $balance = $this->calculBalanceServices->CalculsExpenses($friendGroup);
        return $this->render('calcul/index.html.twig', [
            'balances' => $balance,
        ]);
    }
}
