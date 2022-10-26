<?php
namespace Shop\Service;

use Shop\Models\ProductPurchaseQuery;
use Shop\Models\Purchase;
use Shop\Models\PurchaseQuery;
use stdClass;

class PurchaseService extends BaseService
{
    protected ProductService $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public static function getProductsFromPurchaseId($purchaseId)
    {
        $products = ProductPurchaseQuery::create()
                                ->filterByPurchaseId($purchaseId)
                                ->find();
        return $products->getData();
    }

    public static function getAllPurchases()
    {
        return PurchaseQuery::create()->find();
    }
    public static function getPurchasesByUser($userLoggedIn)
    {
        return PurchaseQuery::create()
                ->filterByUser($userLoggedIn)
                ->find();
    }

    public function placeOrder($basket, $discount, $userLoggedIn)
    {
        $purchase = new Purchase();
        $total = 0;

        foreach(json_decode($basket) as $product) 
        {
            $productObject = $this->productService->readProductById($product->productId);
            $purchase->addProduct($productObject);
            $subtotal = $productObject->getPrice() * $product->quantity;
            $total = $total + $subtotal;
        }

        $purchase->setTotalPrice($total);

        if ($discount != null)
        {
            $discountDecimal = 1 - ($discount->getPercentage() / 100);
            $purchase->setDiscount($discount);
            $purchase->setTotalAfterDiscount($total * $discountDecimal);
        }

        if ($userLoggedIn != null)
        {
            $purchase->setUser($userLoggedIn);
        }

        $purchase->save();

        foreach(json_decode($basket) as $product)
        {
            if ($product->quantity == 1) {
                continue;
            }

            $productObject = $this->productService->readProductById($product->productId);
            $order = ProductPurchaseQuery::create()
                                ->filterByProductId($productObject->getProductId())
                                ->findOneByPurchaseId($purchase->getPurchaseId());

            $order->setQuantity($product->quantity);
            $order->save();
        }
    }
}