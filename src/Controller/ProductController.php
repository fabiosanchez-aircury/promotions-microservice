<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'product_lowest_price', methods: ['POST'])]
    public function lowestPrice(Request $request, int $id, SerializerInterface $serializer): Response
    {

        if($request->headers->has('force_fail')){
            return new JsonResponse(['error' => 'Failiture message'], $request->headers->get('force_fail'));
        }


        // 1. Deserialize JSON data into a DTO (Data Transfer Object)
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');
        dd($lowestPriceEnquiry);
        // 2. Pass the DTO into a promotions filter (the appropriate promotion will be applied)
        // 3. Return the modified DTO

        return new JsonResponse([
            "quantity"=> 5,
            "request_location"=> "UK",
            "voucher_code"=> "0U812",
            "request_date"=> "2022-04-04",
            "product_id"=> $id,
            "price" => 100,
            "discounted_price"=> 50,
            "promotion_id" => 3,
            "promotion_name" => "Black Friday half price"
        ],200);
    }

}