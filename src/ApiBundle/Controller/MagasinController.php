<?php
namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Magasin;

class MagasinController extends Controller
{



    /**
     * @Rest\View()
     * @Rest\Get("/api/magasins")
     */
    public function getMagasinAction(Request $request)
    {
        $magasins = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Magasin')
            ->findAll();
        /* @var $places Place[] */

        return $magasins;
    }


    /**
     * @Rest\View()
     * @Rest\Get("/api/magasins/{magasin_id}")
     */
    public function getPlaceAction(Request $request)
    {
        $magasin = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Place')
            ->find($request->get('magasin_id'));
        /* @var $place Place */


        return $magasin;
    }
}