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
 * @Route("/")
 */
class BusinessSearchController extends Controller
{
    /**
     * @Route("/", name="business_search", methods="GET")
     */
    public function searchAction(Request $request): Response
    {
        $searchString = $request->get('q');

        $finder = $this->container->get('fos_elastica.finder.app.business');
        
        $paginator  = $this->get('knp_paginator');

        if($searchString)
        {
            $resultset = $finder->createPaginatorAdapter("*" . $searchString . "*");
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

            return $this->render('search/results.html.twig', ['results' => $pagination, 'search' => $searchString]);
        }
        return $this->render('search/index.html.twig');
	}

    /**
     * @Route("/about/{id}", name="business_about", methods="GET")
     */
    public function aboutBusiness(Business $business): Response
    {
        return $this->render('search/about.html.twig',['business' => $business]);
    }
}