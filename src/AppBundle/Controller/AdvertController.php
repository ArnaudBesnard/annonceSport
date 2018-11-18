<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Advert controller.
 *
 * @Route("/")
 */
class AdvertController extends Controller
{
    /**
     * Lists all advert entities.
     *
     * @Route("/", name="advert_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('AppBundle:Advert')->findBy(
            array('published' => 1), // Critere
            array('postedAt' => 'desc'),        // Tri
            6,                              // Limite
            0                               // Offset
        );
        return $this->render('advert/index.html.twig', array(
            'adverts' => $adverts,
        ));

    }

    /**
     * Lists all advert entities.
     *
     * @Route("/showAll", name="advert_showAll")
     * @Method("GET")
     */
    public function showAllAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('AppBundle:Advert')->findBy(
            array('published' => 1), // Critere
            array('postedAt' => 'desc'),        // Tri
            null,                              // Limite
            0                               // Offset
        );
        $advert  = $this->get('knp_paginator')->paginate(
            $adverts,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/, 4/*nbre d'éléments par page*/
        );
        return $this->render('advert/showAll.html.twig', array(
            'advert' => $advert,
        ));
    }

    /**
     * Search
     *
     * @Route("/search", name="advert_search")
     *
     */
    public function searchAction(){
        $em = $this->getDoctrine()->getManager();
        $advert = new Advert();
        $form = $this->createFormBuilder($advert)
            ->add('Title', TextType::class)
            ->add('Category', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();
        
        return $this->render('advert/search.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new advert entity.
     *
     * @Route("/new", name="advert_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $advert = new Advert();
        $form = $this->createForm('AppBundle\Form\AdvertType', $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('advert_show', array('id' => $advert->getId()));
        }

        return $this->render('advert/new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a advert entity.
     *
     * @Route("/{id}", name="advert_show")
     * @Method("GET")
     */
    public function showAction(Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);

        return $this->render('advert/show.html.twig', array(
            'advert' => $advert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing advert entity.
     *
     * @Route("/{id}/edit", name="advert_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);
        $editForm = $this->createForm('AppBundle\Form\AdvertType', $advert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advert_show', array('id' => $advert->getId()));
        }

        return $this->render('advert/edit.html.twig', array(
            'advert' => $advert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a advert entity.
     *
     * @Route("/{id}", name="advert_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Advert $advert)
    {
        $form = $this->createDeleteForm($advert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }
        return $this->redirectToRoute('advert_index');
    }

    private function createDeleteForm(Advert $advert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('advert_delete', array('id' => $advert->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/menu", name="advert_menu")
     * @Method("GET")
     */
    public function menuAction()
  {
    $repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('AppBundle:Advert');

    $listAdverts = $repository->findAll();

    foreach ($listAdverts as $advert) {
    // $advert est une instance de Advert
    //echo $advert->getContent();

    return $this->render('advert/menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
    }
  }
     /**
     * @Route("/categories", name="advert_categories")
     * @Method("GET")
     */
    public function viewCategoriesAction()
  {
    $repository = $this
    ->getDoctrine()
    ->getManager()
        ->getRepository('AppBundle:Categories');

    $listCategories = $repository->findAll();

    foreach ($listCategories as $category) {
    // $advert est une instance de Advert
    //echo $advert->getContent();

    return $this->render('advert/categories.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listCategories' => $listCategories
    ));
    }
  }
}
