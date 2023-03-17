<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class SumController extends AbstractController {
    
    /**
     *  @Route("/add/{num1}/{num2}", name="sum_route") // JUAN
     */    
    public function sum(int $num1, int $num2) { // jUAN

        $result = $num1 + $num2;

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'result' => $result
            
        ]);

        return $response;    
    }

}

