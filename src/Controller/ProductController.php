<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'product_lowest_price', methods: ['POST'])]
    public function lowestPrice(Request $request, int $id, DTOSerializer $serializer): Response
    {

        if($request->headers->has('force_fail')){
            return new JsonResponse(['error' => 'Failiture message'], $request->headers->get('force_fail'));
        }


        // 1. Deserialize JSON data into a DTO (Data Transfer Object)
        /** @var LowestPriceEnquiry $lowestPriceEnquiry */
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');

        // 2. Pass the DTO into a promotions filter (the appropriate promotion will be applied)
        // 3. Return the modified DTO
        $lowestPriceEnquiry->setDiscountedPrice(50);
        $lowestPriceEnquiry->setPrice(100);
        $lowestPriceEnquiry->setPromotionId(3);
        $lowestPriceEnquiry->setPromotionName("Black Friday half price");

        $responseContent = $serializer->serialize($lowestPriceEnquiry, 'json');

        return new Response($responseContent, 200);
    }

}