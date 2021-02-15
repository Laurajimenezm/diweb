<?php

namespace App\Controller;

use App\Entity\Gatoperro;
use App\Form\GatoperroType;
use App\Repository\GatoperroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gatoperro")
 */
class GatoperroController extends AbstractController
{
    /**
     * @Route("/", name="gatoperro_index", methods={"GET"})
     */
    public function index(GatoperroRepository $gatoperroRepository): Response
    {
        return $this->render('gatoperro/index.html.twig', [
            'gatoperros' => $gatoperroRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gatoperro_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gatoperro = new Gatoperro();
        $form = $this->createForm(GatoperroType::class, $gatoperro);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gatoperro);
            $entityManager->flush();
        

            return $this->redirectToRoute('gatoperro_index');
        }

        return $this->render('gatoperro/new.html.twig', [
            'gatoperro' => $gatoperro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gatoperro_show", methods={"GET"})
     */
    public function show(Gatoperro $gatoperro): Response
    {
        return $this->render('gatoperro/show.html.twig', [
            'gatoperro' => $gatoperro,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gatoperro_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gatoperro $gatoperro): Response
    {
        $form = $this->createForm(GatoperroType::class, $gatoperro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gatoperro_index');
        }

        return $this->render('gatoperro/edit.html.twig', [
            'gatoperro' => $gatoperro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gatoperro_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Gatoperro $gatoperro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gatoperro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gatoperro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gatoperro_index');
    }
}
