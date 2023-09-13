<?php


namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RegistrationController extends AbstractController
{
    public function __construct(Environment $twig, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->entityManager = $em;

    }
    #[Route('/add', name: 'add')]
    public function registration(Request $request): Response
    {

        $form = $this->createForm(RegistrationType::class);


        return $this->render('connectionRelate/registration.html.twig', [
            'form' => $form->createView()

        ]);
    }
}
