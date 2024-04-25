<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController
{
    #[Route('/products/{id}/lowest-price', name: 'product_lowest_price', methods: ['POST'])]
    public function lowestPrice(int $id): Response
    {
        dd($id);
    }

}