<?php
namespace Shop\Validation;

use Respect\Validation\Validator as v;

class UserValidation extends BaseValidation
{
    public static function LoginUserValidate($post)
    {
        return self::validate(function() use ($post) {
            v::key("username", v::email()->notEmpty())
             ->key("password", v::stringVal()->notEmpty())
            ->assert((array)$post);
        });
    }

    public static function RegisterUserValidate($post)
    {
        return self::validate(function() use ($post) {
            v::key("forename", v::stringVal()->notEmpty()->length(3, 25))
             ->key("surname", v::stringVal()->notEmpty()->length(3, 25))
             ->key("username", v::email()->notEmpty())
             ->key("password", v::stringVal()->notEmpty()->length(3, 100))
             ->key("password2", v::stringVal()->notEmpty()->length(3, 100))
            ->assert((array)$post);
        });
    }
}