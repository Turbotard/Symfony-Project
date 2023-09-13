<?php
namespace App\Services;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddUserServices{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator){
        $this->entityManager = $entityManager;
        $this->validator = $validator;

    }


    public function addUser(Users $user)
    {
        $entityManager = $this->entityManager->getRepository(Users::class);
        $email = $entityManager->findOneByEmail($user->getEmail());

        if ($email) {
            throw new \Exception('Invalid Email');
        }else {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
        return $user;
    }



}