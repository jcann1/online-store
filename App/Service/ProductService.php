<?php
namespace Shop\Service;

use Shop\Models\Product;
use Shop\Models\ProductQuery;

class ProductService extends BaseService
{
    public static function createProduct($post)
    {
        $product = new Product();
        $product->setName($post->ProductName);
        $product->setDescription($post->ProductDescription);
        $product->setCategory($post->Category);
        $product->setQuantity($post->Quantity);
        $product->setPrice($post->Price);
        $product->save();

        return array('Created Product', '/');
    }

    public static function readAllProduct()
    {
        return ProductQuery::create()
                    ->filterByIsDeleted(false)
                    ->find();
    }

    public static function readProductById($id)
    {
        $query = new ProductQuery();
        $Product = $query->findPK($id);
        return $Product;
    }

    public static function updateProductById($id, $post)
    {
        $product = ProductQuery::create()->findOneByProductId($id);
        $product->setName($post->ProductName);
        $product->setDescription($post->ProductDescription);
        $product->setCategory($post->Category);
        $product->setQuantity($post->Quantity);
        $product->setPrice($post->Price);
        $product->save();

        return array('Product Updated', '/');
    }

    public static function deleteProduct($id)
    {
        (new Product)->deleteProduct($id);
    }

    public static function RenderProductImage($imageURL)
    {
        if ($imageURL == "product/default/default_product.png")
        {
            echo "<img class='card-img-top' src='/img/product/default/default_product.png'>";
            return;
        }

        if (str_contains($imageURL, "https://"))
        {
            echo "<img class='card-img-top' src='$imageURL'>";
            return;
        }

        echo "<img class='card-img-top' src='/img/$imageURL'>";
    }
    
    public static function uploadProductImage($id, $ext, $target_file)
    {
        $rename = "../Views/img/product/Products/" . $id . "." . $ext;
        $product = ProductQuery::create()->findOneByProductId($id);

        if(move_uploaded_file($_FILES['ProductImage']['tmp_name'], $target_file))
            {
                rename($target_file, $rename);
                $product->setImageUrl("product/Products/" . $id . "." . $ext);
                $product->save();
            }
        
        return array('Product Image Updated', '/');
    }
}