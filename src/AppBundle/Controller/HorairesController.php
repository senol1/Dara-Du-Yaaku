<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Horaires;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Horaire controller.
 *
 */
class HorairesController extends Controller
{
    /**
     * Lists all horaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $horaires = $em->getRepository('AppBundle:Horaires')->findAll();

        return $this->render('horaires/index.html.twig', array(
            'horaires' => $horaires,
        ));
    }

    /**
     * Creates a new horaire entity.
     *
     */
    public function newAction(Request $request)
    {
        $horaire = new Horaires();
        $form = $this->createForm('AppBundle\Form\HorairesType', $horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($horaire);
            $em->flush();

            return $this->redirectToRoute('horaires_show', array('id' => $horaire->getId()));
        }

        return $this->render('horaires/new.html.twig', array(
            'horaire' => $horaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a horaire entity.
     *
     */
    public function showAction(Horaires $horaire)
    {
        $deleteForm = $this->createDeleteForm($horaire);

        return $this->render('horaires/show.html.twig', array(
            'horaire' => $horaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing horaire entity.
     *
     */
    public function editAction(Request $request, Horaires $horaire)
    {
        $deleteForm = $this->createDeleteForm($horaire);
        $editForm = $this->createForm('AppBundle\Form\HorairesType', $horaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horaires_edit', array('id' => $horaire->getId()));
        }

        return $this->render('horaires/edit.html.twig', array(
            'horaire' => $horaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a horaire entity.
     *
     */
    public function deleteAction(Request $request, Horaires $horaire)
    {
        $form = $this->createDeleteForm($horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($horaire);
            $em->flush();
        }

        return $this->redirectToRoute('horaires_index');
    }

    /**
     * Creates a form to delete a horaire entity.
     *
     * @param Horaires $horaire The horaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Horaires $horaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('horaires_delete', array('id' => $horaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
