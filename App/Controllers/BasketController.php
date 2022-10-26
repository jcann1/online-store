<?php
namespace Shop\Controllers;

use Shop\Service\BasketService;
use Shop\Service\ProductService;

class BasketController extends BaseController
{
    protected ProductService $productService;
    protected BasketService $basketService;

    function __construct()
    {
        $this->productService = new ProductService();
        $this->basketService = new BasketService();
    }

    public function index()
    {
        $this->_render("basket");
    }

    public function addProduct($id)
    {
        $product = $this->productService->readProductById($id);
        $currentBasket = $this->GetCookie("basket");
        $newBasket = $this->basketService->addProduct($currentBasket, $product);
        $this->updateCookie('basket', $newBasket);
        $this->redirectWithMessage("Product added to basket successfully", "/");
    }

    public static function renderProductsInBasketTable($products)
    {
        foreach ($products as $product)
        {
            echo "<tr>";
            echo "<th scope='row'>" . $product['product']->getName() . "</th>";
            echo "<th>" . "£" . number_format(round($product['product']->getPrice(), 2), 2) . "</th>";
            echo "<th>" . $product['quantity'] . "</th>";
            echo "<th>" . "£" . number_format(round($product['subtotal'], 2), 2) . "</th>";
            echo "</tr>";
        }
    }

    public static function renderDiscountForm() 
    {
        echo "  <form action='/discount/apply' method='post' class='mx-4'>
                    <label for='discount' class='form-label'>Discount Code</label>
                    <input type='text' class='form-control' id='discount' name='discount'>
                    <button type='submit' class='btn btn-primary'>Apply Discount</button>
                </form>";
    }

    public static function DoubleToCurrency($amount)
    {
        return "£" . number_format(round($amount, 2), 2);
    }

    public static function calculateTotalWithDiscount($discount, $total)
    {
        $discountDecimal = 1 - ($discount->getPercentage() / 100);
        return $total * $discountDecimal;
    }
}