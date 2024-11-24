<?php

namespace App\Controller;

use App\Entity\Favourite;
use App\Form\FavouriteType;
use App\Repository\FavouriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile/favourite')]
final class ProfileFavouriteController extends AbstractController{
    #[Route(name: 'app_profile_favourite_index', methods: ['GET'])]
    public function index(FavouriteRepository $favouriteRepository): Response
    {
        return $this->render('profile_favourite/index.html.twig', [
            'favourites' => $favouriteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_profile_favourite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $favourite = new Favourite();
        $form = $this->createForm(FavouriteType::class, $favourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($favourite);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_favourite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile_favourite/new.html.twig', [
            'favourite' => $favourite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_favourite_show', methods: ['GET'])]
    public function show(Favourite $favourite): Response
    {
        return $this->render('profile_favourite/show.html.twig', [
            'favourite' => $favourite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profile_favourite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Favourite $favourite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FavouriteType::class, $favourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_favourite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile_favourite/edit.html.twig', [
            'favourite' => $favourite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_favourite_delete', methods: ['POST'])]
    public function delete(Request $request, Favourite $favourite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favourite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($favourite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profile_favourite_index', [], Response::HTTP_SEE_OTHER);
    }
}
