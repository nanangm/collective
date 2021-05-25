<?php

namespace App\Controller;

use App\Entity\Calculator;
use App\Form\CalculatorType;
use App\Repository\CalculatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/calculator')]
class CalculatorController extends AbstractController
{
    #[Route('/', name: 'calculator_index', methods: ['GET'])]
    public function index(CalculatorRepository $calculatorRepository): Response
    {
        return $this->render('calculator/index.html.twig', [
            'calculators' => $calculatorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'calculator_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $calculator = new Calculator();
        $form = $this->createForm(CalculatorType::class, $calculator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calculator = $form->getData();
            $result = $calculator->performCalculation();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calculator);
            $entityManager->flush();

            return $this->redirectToRoute('calculator_index');
        }

        return $this->render('calculator/new.html.twig', [
            'calculator' => $calculator,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'calculator_show', methods: ['GET'])]
    public function show(Calculator $calculator): Response
    {
        return $this->render('calculator/show.html.twig', [
            'calculator' => $calculator,
        ]);
    }

    #[Route('/{id}/edit', name: 'calculator_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calculator $calculator): Response
    {
        $form = $this->createForm(CalculatorType::class, $calculator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calculator_index');
        }

        return $this->render('calculator/edit.html.twig', [
            'calculator' => $calculator,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'calculator_delete', methods: ['POST'])]
    public function delete(Request $request, Calculator $calculator): Response
    {
        if ($this->isCsrfTokenValid('delete' . $calculator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calculator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calculator_index');
    }
}
