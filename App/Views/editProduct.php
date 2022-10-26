<?php

use Shop\Service\ProductService;

$product = ProductService::readProductById($_SESSION["productId"]);
        $id = $product->getProductId();
        $name = $product->getName();
        $description = $product->getDescription();
        $category = $product->getCategory();
        $quantity = $product->getQuantity();
        $price = $product->getPrice();

echo "<div class='container'>
    <form method='POST' action='/product/edit/image/$id' enctype='multipart/form-data'>
        <div class='mb-3'>
            <label for='productImage' class='form-label'>Upload Product Image</label>
            <input class='form-control form-control-sm' id='productImage' type='file' name='ProductImage'>
        </div>

        <button type='submit' class='btn btn-primary'>Submit</button>
    </form>
</div>
<br>"
.
"<div class='container'>
    <form method='POST' action='/product/edit/$id'>
        <div class='mb-3'>
            <label for='ProductName' class='form-label'>Product Name</label>
            <input type='text' class='form-control' id='ProductName' aria-describedby='ProductName' name='ProductName' value='$name'>
        </div>

        <div class='mb-3'>
            <label for='ProductDescription' class='form-label'>ProductDescription</label>
            <input type='text' class='form-control' id='ProductDescription' aria-describedby='ProductDescription' name='ProductDescription' value='$description'>
        </div>

        <div class='mb-3'>
            <label for='Category' class='form-label'>Category</label>
            <input type='text' class='form-control' id='Category' aria-describedby='Category' name='Category' value='$category'>
        </div>

        <div class='mb-3'>
            <label for='Quantity' class='form-label'>Quantity</label>
            <input type='text' class='form-control' id='Quantity' aria-describedby='Quantity' name='Quantity' value='$quantity'>
        </div>

        <div class='mb-3'>
            <label for='Price' class='form-label'>Price</label>
            <input type='Price' class='form-control' id='Price' name='Price' value='$price'>
        </div>

        <button type='submit' class='btn btn-primary'>Submit</button>
    </form>
</div>";