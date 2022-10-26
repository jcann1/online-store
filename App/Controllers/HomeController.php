<?php
namespace Shop\Controllers;

use Shop\Models\ProductQuery;
use Shop\Service\ProductService;
use Shop\Validation\ProductValidation;

class HomeController extends BaseController
{
    protected ProductService $productService;

    function __construct()
    {
        $this->productService = new ProductService();   
    }

    public function index()
    {
        $this->_render("home");
    }

    public function createProductPage()
    {
        if (!isset($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have permission to view this page", "/");
        }

        $this->_render("createProduct");
    }
    
    public function editProductPage($id)
    {
        if (!isset($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have permission to view this page", "/");
        }

        $product = (new ProductQuery)->findOneByProductId($id);
        if($product == null)
        {
            return $this->redirectWithMessage("Product does not exist", "/");
        }

        $_SESSION["productId"] = $id;
        $this->_render("editProduct");
    }

    public function createProduct($post)
    {
        if (!isset($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have permission to do this action", "/");
        }

        $validation = ProductValidation::ProductValidation($post);
        if (!$validation[0])
        {
            return $this->redirectWithPersistance($validation[1], 'createProduct');
        }

        $response = $this->productService->createProduct($post);
        $this->redirectWithMessage($response[0], $response[1]);
    }

    public function editProduct($id, $post)
    {
        if (!isset($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have permission to do this action", "/");
        }

        $product = (new ProductQuery)->findOneByProductId($id);
        if($product == null)
        {
            return $this->redirectWithMessage("Product does not exist", "/");
        }
        
        $validation = ProductValidation::ProductValidation($post);
        if (!$validation[0])
        {
            return $this->redirectWithMessage($validation[1], "/product/edit/$id");
        }

        $response = productService::updateProductById($id, $post);
        $this->redirectWithMessage($response[0], $response[1]);
    }

    public function deleteProduct($id)
    {
        if (!isset($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have permission to do this action", "/");
        }

        $product = (new ProductQuery)->findOneByProductId($id);
        if($product == null)
        {
            return $this->redirectWithMessage("Product does not exist", "/");
        }

        $this->productService->deleteProduct($id);
        $this->redirectWithMessage("Deleted Product", "/");
    }

    public function uploadProductImage($id)
    {
        $product = (new ProductQuery)->findOneByProductId($id);
        if($product == null)
        {
            return $this->redirectWithMessage("Product does not exist", "/");
        }

        $target_file = "../Views/img/product/Products/" . $_FILES['ProductImage']['name'];
        $ext = pathinfo($target_file, PATHINFO_EXTENSION);
        $validate = array("Name" => $_FILES['ProductImage']['name'], "Ext" => $ext);

        $validation = ProductValidation::ProductImageValidation($validate);
        if(!$validation[0])
        {
            return $this->redirectWithMessage($validation[1], "/product/edit/$id");
        }
        
        $response = productService::uploadProductImage($id, $ext, $target_file);
        $this->redirectWithMessage($response[0], $response[1]);
    }
}