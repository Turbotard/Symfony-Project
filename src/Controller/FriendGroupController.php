<?php

namespace App\Controller;

use App\Entity\FriendGroup;
use App\Form\FriendGroupType;
use App\Repository\FriendGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/friend/group')]
class FriendGroupController extends AbstractController
{
    #[Route('/', name: 'app_friend_group_index', methods: ['GET'])]
    public function index(FriendGroupRepository $friendGroupRepository): Response
    {
        return $this->render('friend_group/index.html.twig', [
            'friend_groups' => $friendGroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_friend_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $friendGroup = new FriendGroup();
        $form = $this->createForm(FriendGroupType::class, $friendGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($friendGroup);
            $entityManager->flush();

            return $this->redirectToRoute('app_friend_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('friend_group/new.html.twig', [
            'friend_group' => $friendGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_friend_group_show', methods: ['GET'])]
    public function show(FriendGroup $friendGroup): Response
    {
        return $this->render('friend_group/show.html.twig', [
            'friend_group' => $friendGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_friend_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FriendGroup $friendGroup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FriendGroupType::class, $friendGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_friend_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('friend_group/edit.html.twig', [
            'friend_group' => $friendGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_friend_group_delete', methods: ['POST'])]
    public function delete(Request $request, FriendGroup $friendGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$friendGroup->getId(), $request->request->get('_token'))) {
            $entityManager->remove($friendGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_friend_group_index', [], Response::HTTP_SEE_OTHER);
    }
}
