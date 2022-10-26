<?php

use Shop\Controllers\BasketController;
use Shop\Service\ProductService;
$products = ProductService::readAllProduct()->getData();

if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn']->getLevel() > 0)
{
    echo "<a class='btn btn-primary' type='button' href='/product/create'>Create Product</a>";
}

?>

<div class="card-deck">
    <?php
    foreach ($products as $product)
    {
        $id = $product->getProductId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = BasketController::DoubleToCurrency($product->getPrice());
        $imageUrl = $product->getImageUrl();
        echo "  <div class='card my-3' style='width:21rem'>
                    <div class='card-header'>
                        <p class='text-center'>$name</p>
                    </div>";

        productService::RenderProductImage($imageUrl);
        echo "      <div class='card-body text-justify'>
                        <h5 class='card-title'>$description</p>
                        <p class='card-text'>Price: $price</p>
                    </div>
                    <div class='card-footer'>";
                    if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn']->getLevel() > 0)
                    {
                        echo "<a class='btn btn-primary' type='button' href='/product/edit/$id'>Edit</a>
                        <a class='btn btn-primary' type='button' href='/product/delete/$id'>Delete</a>";
                    }

        echo "      <a class='btn btn-primary' type='button' href='/basket/add/$id'>Add to Basket</a>
                    </div>
                </div>";
    }
    ?>
</div>