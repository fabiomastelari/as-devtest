<?php

namespace App\Controller;

use App\Entity\Business;
use App\Form\BusinessType;
use App\Repository\BusinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class BusinessController extends Controller
{
    /**
     * @Route("/", name="business_index", methods="GET")
     */
    public function index(Request $request, BusinessRepository $businessRepository): Response
    {
        $resultset = $businessRepository->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $resultset,
            $request->query->getInt('page', 1),
            10
        );

        $pagination->setCustomParameters(array(
            'align' => 'center', # center|right (for template: twitter_bootstrap_v4_pagination)
            'size' => 'small', # small|large (for template: twitter_bootstrap_v4_pagination)
            'style' => 'bottom'
        ));

        return $this->render('business/index.html.twig', ['businesses' => $pagination]);
    }

    /**
     * @Route("/new", name="business_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $business = new Business();
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($business);
            $em->flush();

            return $this->redirectToRoute('business_index');
        }

        return $this->render('business/new.html.twig', [
            'business' => $business,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="business_edit", methods="GET|POST")
     */
    public function edit(Request $request, Business $business): Response
    {
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('business_edit', ['id' => $business->getId()]);
        }

        return $this->render('business/edit.html.twig', [
            'business' => $business,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="business_delete", methods="DELETE")
     */
    public function delete(Request $request, Business $business): Response
    {
        if ($this->isCsrfTokenValid('delete'.$business->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($business);
            $em->flush();
        }

        return $this->redirectToRoute('business_index');
    }
}
