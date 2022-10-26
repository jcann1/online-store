<?php

namespace Shop\Service;

class BasketService extends BaseService
{
    protected ProductService $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function addProduct($currentBasket, $product)
    {
        $sameProduct = false;
        $basket = json_decode($currentBasket, true);

        // If the same product is being added
        foreach ($basket as $key => $value) {
            if ($value['productId'] == $product->getProductId()) {
                $basket[$key]['quantity'] = $value['quantity'] + 1;
                $sameProduct = true;
            }
        }

        if ($sameProduct == false) {
            $basket[] = ['productId' => $product->getProductId(),
                         'quantity' => 1];    
        }

        return json_encode($basket);
    }

    public function getProductsOnBasket($basket)
    {
        if (count($basket) == 0) {
            return null;
        }

        $products = array();

        foreach($basket as $product) {
            $productObject = $this->productService->readProductById($product->productId);
            array_push($products, 
            [ 'product' => $productObject, 
              'quantity' => $product->quantity,
              'subtotal' => ($productObject->getPrice() * $product->quantity)
            ]);
        }

        return $products;
    }
}