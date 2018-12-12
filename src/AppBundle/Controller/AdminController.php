<?php
/**
 * Created by PhpStorm.
 * User: Arno
 * Date: 06/12/2018
 * Time: 22:10
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Departments;
use Symfony\Bridge\Doctrine\Form\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends controller
{
    public function indexAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findBy(
            array('enabled' => 1), // Critere
            array('id' => 'desc'),
            5
        );
        return $this->render('admin/indexAdmin.html.twig', array(
            'users' => $users,
        ));
    }

    public function validAdvertAction(Request $request)
    {
    //A voir
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('AppBundle:Advert')->findBy(
            array('published' => 0), // Critere
            array('postedAt' => 'desc')
        );
        $validForm = $this->createForm('AppBundle\Form\ValidType');
        $validForm->handleRequest($request);
        if ($validForm->isSubmitted() && $validForm->isValid()) {
            $advert->setPublished('1');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }
        return $this->render('admin/validAdvert.html.twig', array(
            'advert' => $advert,
            'validForm' => $validForm->createView(),
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

}