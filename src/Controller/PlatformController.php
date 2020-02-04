<?php

namespace App\Controller;

use App\Entity\Platform;
use App\Form\PlatformType;
use App\Repository\PlatformRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/platform")
 */
class PlatformController extends AbstractController
{

    private $platformRepository;

    public function __construct(
      PlatformRepository $platformRepository
    ) {
      $this->platformRepository = $platformRepository;
    }

    /**
     * @Route("/", name="platform_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('platform/index.html.twig', [
            'platforms' => $this->platformRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="platform_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $platform = new Platform();
        $form = $this->createForm(PlatformType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($platform);
            $entityManager->flush();

            $this->addFlash('success', "The platform has been created !");

            return $this->redirectToRoute('platform_index');
        }

        return $this->render('platform/new.html.twig', [
            'platform' => $platform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="platform_show", methods={"GET"})
     */
    public function show(Platform $platform): Response
    {
        return $this->render('platform/show.html.twig', [
            'platform' => $platform,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="platform_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Platform $platform): Response
    {
        $form = $this->createForm(PlatformType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "The platform has been updated !");

            return $this->redirectToRoute('platform_index');
        }

        return $this->render('platform/edit.html.twig', [
            'platform' => $platform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="platform_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Platform $platform): Response
    {
        if ($this->isCsrfTokenValid('delete'.$platform->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($platform);
            $entityManager->flush();
        }

        $this->addFlash('success', "The platform has been removed !");

        return $this->redirectToRoute('platform_index');
    }
}
