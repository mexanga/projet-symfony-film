<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Form\EditorType;
use App\Repository\EditorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/editor")
 */
class EditorController extends AbstractController
{
    private $editorRepository;

    public function __construct(
      EditorRepository $editorRepository
    ) {
      $this->editorRepository = $editorRepository;
    }

    /**
     * @Route("/", name="editor_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('editor/index.html.twig', [
            'editors' => $this->editorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="editor_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($editor);
            $entityManager->flush();

            $this->addFlash('success', "The editor has been created !");

            return $this->redirectToRoute('editor_index');
        }

        return $this->render('editor/new.html.twig', [
            'editor' => $editor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="editor_show", methods={"GET"})
     */
    public function show(Editor $editor): Response
    {
        return $this->render('editor/show.html.twig', [
            'editor' => $editor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="editor_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Editor $editor): Response
    {
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "The editor has been updated !");

            return $this->redirectToRoute('editor_index');
        }

        return $this->render('editor/edit.html.twig', [
            'editor' => $editor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="editor_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Editor $editor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($editor);
            $entityManager->flush();
        }

        $this->addFlash('success', "The editor has been removed !");

        return $this->redirectToRoute('editor_index');
    }
}
