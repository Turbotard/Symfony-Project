<?php


namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use App\Services\AddUserServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class RegistrationController extends AbstractController
{
    public function __construct(Environment $twig,AddUserServices $addUserServices, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->addUser = $addUserServices;
        $this->entityManager = $em;

    }
    #[Route('/add', name: 'add')]
    public function registration(Request $request): Response
    {

        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addUser->addUser($form->getData());
        }

        return $this->render('connectionRelate/registration.html.twig', [
            'form' => $form->createView()

        ]);
    }
}
