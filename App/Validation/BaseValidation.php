<?php
namespace Shop\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

class BaseValidation
{
    public static function validate(callable $cp)
    {
        try 
        {
            $cp();
            return array(true);
        }
        catch(NestedValidationException $e) 
        { 
            $results = ""; 
            $messages = $e->getMessages();
            foreach ($messages as $key => $value) {
                $results = $results . " $value,";
            }
            return array(false, trim(substr($results, 0, -1)));
        }
    }
}