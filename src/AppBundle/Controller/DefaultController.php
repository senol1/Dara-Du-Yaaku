<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array(
            // ...
        ));
    }

    //fonction geo-localisation
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/carte", name="geolocalisation")
     */
    public function geolocalisationAction()
    {
        return $this->render('AppBundle:Default:geolocalisation.html.twig', array(
            // ...
        ));
    }

}
