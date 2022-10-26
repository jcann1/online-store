<?php
namespace Shop\Validation;

use Respect\Validation\Validator as v;

class DiscountValidation extends BaseValidation
{
    public static function DiscountValidation($post)
    {
        return self::validate(function() use ($post) {
            v::key("code", v::stringVal()->notEmpty()->length(2, 30))
                ->key("percentage", v::intVal()->notEmpty()->between(1, 99))
                ->key("date", v::date())
            ->assert((array)$post);
        });
    }

    public static function ApplyDiscountValidation($post)
    {
        return self::validate(function() use ($post) {
            v::key("discount", v::stringVal()->notEmpty()->length(2, 30))
            ->assert((array)$post);
        });
    }
}