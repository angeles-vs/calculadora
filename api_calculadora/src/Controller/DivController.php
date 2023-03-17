<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class DivController extends AbstractController {
    
    /**
     *  @Route("/divide/{num1}/{num2}", name="div_route") 
     */    
    public function div(int $num1, int $num2) { 

        $result = $num1 / $num2;

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'result' => number_format($result,2,'.',''),
            
        ]);
        return $response;    
    }

}

