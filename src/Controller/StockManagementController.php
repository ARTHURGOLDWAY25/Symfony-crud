<?php

namespace App\Controller;

use App\Entity\StockManagement;
use App\Form\StockManagement1Type;
use App\Repository\StockManagementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/stock-management')]
#[IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")]
class StockManagementController extends AbstractController
{
    #[Route('/', name: 'app_stock_management_index', methods: ['GET'])]
    public function index(StockManagementRepository $stockManagementRepository): Response
    {
        return $this->render('stock_management/index.html.twig', [
            'stock_managements' => $stockManagementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stock_management_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stockManagement = new StockManagement();
        $form = $this->createForm(StockManagement1Type::class, $stockManagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stockManagement);
            $entityManager->flush();

            return $this->redirectToRoute('app_stock_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_management/new.html.twig', [
            'stock_management' => $stockManagement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stock_management_show', methods: ['GET'])]
    public function show(StockManagement $stockManagement): Response
    {
        return $this->render('stock_management/show.html.twig', [
            'stock_management' => $stockManagement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_stock_management_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StockManagement $stockManagement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StockManagement1Type::class, $stockManagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_stock_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_management/edit.html.twig', [
            'stock_management' => $stockManagement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stock_management_delete', methods: ['POST'])]
    public function delete(Request $request, StockManagement $stockManagement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stockManagement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($stockManagement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_stock_management_index', [], Response::HTTP_SEE_OTHER);
    }
}
