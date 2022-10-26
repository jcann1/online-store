<?php

namespace Shop\MockData;

use Shop\Models\Base\ProductPurchaseQuery;
use Shop\Models\Product;
use Shop\Models\Purchase;
use Shop\Models\User;
use Shop\Service\ProductService;

class SaveMockData
{
    // BEFORE YOU DO ANYTHING 
    // THE MOCK DATA MUST BE DONE IN A SPECIFIC ORDER
    // FIRST -> .\vendor\bin\propel sql:insert
    // SECOND -> /mock/user
    // THIRD -> /mock/product
    // LAST -> /mock/purchase

    public static function CreateUsersFromJSON()
    {
        $strJsonFileContents = file_get_contents("../MockData/Users.json");
        $users = json_decode($strJsonFileContents);

        foreach($users as $user)
        {
            $userObj = new User();

            $userObj->setUsername($user->username);
            $userObj->setForename($user->forename);
            $userObj->setSurname($user->surname);
            $userObj->setLevel($user->level);
            $userObj->setPassword(password_hash($user->password, PASSWORD_BCRYPT));
            $userObj->setIsBanned($user->isBanned);
            $userObj->save();
        }
    }

    public static function CreateProductsFromJSON()
    {
        $strJsonFileContents = file_get_contents("../MockData/Products.json");
        $products = json_decode($strJsonFileContents);

        foreach($products as $product)
        {
            $productObj = new Product();

            $productObj->setName($product->name);
            $productObj->setDescription($product->description);
            $productObj->setCategory($product->category);
            $productObj->setQuantity($product->quantity);
            $productObj->setPrice($product->price);
            $productObj->setImageUrl($product->imageUrl);
            $productObj->setIsDeleted($product->isDeleted);
            $productObj->save();
        }
    }

    public static function Create50Purchase()
    {
        $productService = new ProductService();

        for ($i = 1; $i <= 50; $i++) 
        {
            $fakeBasket = array();
            for ($j = 1; $j <= 4; $j++) 
            {
                array_push($fakeBasket, ["productId" => rand(1, 10), "quantity" => rand(1, 3)]);
            }

            $purchase = new Purchase();

            foreach($fakeBasket as $basket)
            {
                $total = 0;

                $productObject = $productService->readProductById($basket['productId']);
                $purchase->addProduct($productObject);
                $subtotal = $productObject->getPrice() * $basket['quantity'];
                $total = $total + $subtotal;

                $purchase->setTotalPrice($total);
            }

            $purchase->setUserId(rand(1, 7));
            $purchase->save();

            foreach($fakeBasket as $product)
            {
                if ($product['quantity'] == 1) {
                    continue;
                }

                $productObject = $productService->readProductById($product['productId']);
                $order = ProductPurchaseQuery::create()
                                    ->filterByProductId($productObject->getProductId())
                                    ->findOneByPurchaseId($purchase->getPurchaseId());

                $order->setQuantity($product['quantity']);
                $order->save();
            }
        }
    }
}
