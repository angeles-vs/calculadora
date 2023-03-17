<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class MultController extends AbstractController {
    
    /**
     *  @Route("/times/{num1}/{num2}", name="mult_route") 
     */    
    public function mult(int $num1, int $num2) { 

        $result = $num1 * $num2;

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'result' => $result
            
        ]);
        return $response;    
    }

}

