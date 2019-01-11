<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Categories;
use AppBundle\Entity\Departments;
use Symfony\Bridge\Doctrine\Form\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends controller
{
    public function indexAdminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findBy(
            array('enabled' => 1), // Critere
            array('id' => 'desc'),
            10
        );
        return $this->render('admin/indexAdmin.html.twig', array(
            'users' => $users,
        ));
    }

    public function showUnvalidAdvertAction()
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('AppBundle:Advert')->findBy(
            array('published' => 0), // Critere
            array('postedAt' => 'desc')
        );
        return $this->render('admin/validAdvert.html.twig', array(
            'advert' => $advert,
        ));
    }

    public function countUnvalidAction(){
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('COUNT(a.id)')
            ->from(Advert::class, 'a')
            ->where('a.published = :published')
            ->setParameter('published', 0);
        $query = $queryBuilder->getQuery();
        $count = $query->getSingleScalarResult();
        return new Response($count);
    }

    public function viewCategoriesAction(Request $request)
    {
        $categories = new Categories();
        $form = $this->createForm('AppBundle\Form\CategoriesType', $categories);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories);
            $em->flush();
            return $this->redirectToRoute('advert_categories');
        }
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Categories');
        $listCategories = $repository->findBy(array(), array('category' => 'ASC'));
        foreach ($listCategories as $category) {
            return $this->render('advert/categories.html.twig', array(
                'listCategories' => $listCategories,
                'form' => $form->createView()
            ));
        }
    }

}