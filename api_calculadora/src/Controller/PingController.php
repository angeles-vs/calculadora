<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class PingController extends AbstractController {
    
    /**
     *  @Route("/", name="ping_route") 
     */    
    public function ping() { 

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
        ]);
        return $response;    
    }

}

