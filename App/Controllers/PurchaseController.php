<?php
namespace Shop\Controllers;

use Shop\Models\PurchaseQuery;
use Shop\Service\ProductService;
use Shop\Service\PurchaseService;

class PurchaseController extends BaseController
{
    protected PurchaseService $PurchaseService;

    function __construct()
    {
        $this->PurchaseService = new PurchaseService();   
    }

    public function index()
    {
        if (!isset($_SESSION['userLoggedIn']))
        {
            return $this->redirectWithMessage("You do not have permission to view this page", "/");
        }

        $this->_render("purchases");
    }

    public function viewPurchases($purchaseId)
    {
        $purchase = (new PurchaseQuery)->findOneByPurchaseId($purchaseId);
        if ($purchase == null)
        {
            $this->redirectWithMessage("Purchase does not exist", "/");
        }

        $_SESSION["purchaseId"] = $purchaseId;
        $this->_render('viewProduct');
    }

    public function placeOrder($basket, $discount, $userLoggedIn)
    {
        (new PurchaseService)->placeOrder($basket, $discount, $userLoggedIn);
        unset($_SESSION['discount']);
        $this->updateCookie('basket', "{}");
        $this->redirectWithMessage("Order placed!", "/");
    }

    public static function renderViewProducts($purchaseId)
    {
        $productsQuery = PurchaseService::getProductsFromPurchaseId($purchaseId);
        foreach($productsQuery as $productQuery)
        {
            $getQuantity = $productQuery->getQuantity();
            $getProductId = $productQuery->getProductId();
            $products = ProductService::readProductById($getProductId);

            $getName = $products->getName();
            $getDescription = $products->getDescription();
            $getPrice = $products->getPrice();

            echo "  <tr>
                        <th scope='row'>$getName</th>
                        <td>$getDescription</td>
                        <td>$getPrice</td>
                        <td>$getQuantity</td>
                    </tr>";
        }
    }

    public static function renderUserPurchases($userLoggedIn)
    {
        $purchases = PurchaseService::getPurchasesByUser($userLoggedIn);
        foreach($purchases as $purchase)
        {
            $id = $purchase->getPurchaseId();
            $status = $purchase->getStatus();
            echo "<tr>";
            echo "<th scope='row'>$id</th>";
            echo "<td>$status</td>";
            echo "<td><a class='btn btn-primary type='button' href='/purchase/$id'>View Purchases</a></td>";
            echo "</tr>";
        }                 
    }
}