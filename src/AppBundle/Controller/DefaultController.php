<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array(
            // ...
        ));
    }

    //fonction geo-localisation
    public function geolocalisationAction()
    {
        return $this->render('AppBundle:Default:geolocalisation.html.twig', array(
            // ...
        ));
    }

    public function findmagAction()
    {
        return $this->render('AppBundle:Default:findmag.html.twig', array(
            // ...
        ));
    }

}
