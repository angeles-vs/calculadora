<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class RestController extends AbstractController {
    
    /**
     *  @Route("/minus/{num1}/{num2}", name="rest_route") 
     */    
    public function rest(int $num1, int $num2) { 

        $result = $num1 - $num2;

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'result' => $result
            
        ]);
        return $response;    
    }

}

