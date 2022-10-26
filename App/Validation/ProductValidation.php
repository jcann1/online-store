<?php
namespace Shop\Validation;

use Respect\Validation\Validator as v;

class ProductValidation extends BaseValidation
{
    public static function ProductValidation($post)
    {
        return self::validate(function() use ($post) {
            v::key("ProductName", v::stringVal()->notEmpty()->length(1, 50))
                ->key("ProductDescription", v::stringVal()->notEmpty()->length(5, 50))
                ->key("Category", v::stringVal()->notEmpty()->length(1, 50))
                ->key("Quantity", v::intVal()->notEmpty()->length(1, 11))
                ->key("Price", v::floatVal()->notEmpty()->decimal(2))
            ->assert((array)$post);
        });
    }

    public static function ProductImageValidation($data)
    {
        return self::validate(function() use ($data) {
            v::key("Name", v::stringVal()->notEmpty())
                ->key("Ext", v::containsAny(['jpg', 'jpeg', 'png']))
            ->assert((array)$data);
        });
    }
}