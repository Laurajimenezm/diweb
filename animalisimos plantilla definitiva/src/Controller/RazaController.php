<?php

namespace App\Controller;

use App\Entity\Raza;
use App\Form\RazaType;
use App\Repository\RazaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/raza")
 */
class RazaController extends AbstractController
{
    /**
     * @Route("/", name="raza_index", methods={"GET"})
     */
    public function index(RazaRepository $razaRepository): Response
    {
        return $this->render('raza/index.html.twig', [
            'razas' => $razaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="raza_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $raza = new Raza();
        $form = $this->createForm(RazaType::class, $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($raza);
            $entityManager->flush();

            return $this->redirectToRoute('raza_index');
        }

        return $this->render('raza/new.html.twig', [
            'raza' => $raza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="raza_show", methods={"GET"})
     */
    public function show(Raza $raza): Response
    {
        return $this->render('raza/show.html.twig', [
            'raza' => $raza,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="raza_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Raza $raza): Response
    {
        $form = $this->createForm(RazaType::class, $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('raza_index');
        }

        return $this->render('raza/edit.html.twig', [
            'raza' => $raza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="raza_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Raza $raza): Response
    {
        if ($this->isCsrfTokenValid('delete'.$raza->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($raza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('raza_index');
    }
}
