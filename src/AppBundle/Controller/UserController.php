<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all Users.
     *
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('admin/userManager.html.twig', array(
            'users' => $users,
        ));
    }

    public function editAction(Request $request, User $id)
    {

        $editForm = $this->createForm('AppBundle\Form\UserFormType', $id);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);
            $em->flush();

            return $this->redirectToRoute('userManager');
        }

        return $this->render('admin/userEdit.html.twig', array(
            'article' => $id,
            'edit_form' => $editForm->createView(),

        ));
    }

}