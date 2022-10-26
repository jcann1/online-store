<?php

namespace Shop\Service;

use Shop\Models\Discount;
use Shop\Models\DiscountQuery;

class DiscountService extends BaseService
{
    public static function getDiscounts()
    {
        return (new DiscountQuery)->findByValid(true)->getData();
    }

    public static function createDiscount($post)
    {
        $discount = new Discount();
        $discount->setCode($post->code);
        $discount->setPercentage($post->percentage);
        $discount->setDateValid(strtotime($post->date));
        $discount->save();
    }

    public static function invalidateDiscount($id)
    {
        $discount = DiscountQuery::create()->findOneByDiscountId($id);
        $discount->setValid(false);
        $discount->save();
    }

    public static function GetDiscountByCode($code) 
    {
        return DiscountQuery::create()->findOneByCode($code);
    }
}