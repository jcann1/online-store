<?php
namespace Shop\Controllers;

use DateTime;
use Shop\Models\DiscountQuery;
use Shop\Service\DiscountService;
use Shop\Validation\DiscountValidation;

class DiscountController extends BaseController
{
    protected DiscountService $discountService;

    function __construct()
    {
        $this->discountService = new DiscountService();
    }

    public function index()
    {
        $this->_render("discount");
    }

    public static function renderDiscount($discounts)
    {
        foreach ($discounts as $discount)
        {
            $id = $discount->getDiscountId();
            echo "<tr>";
            echo "<th scope='row'>" . $discount->getCode() . "</th>";
            echo "<th>" . $discount->getPercentage() . "</th>";
            echo "<th>" . $discount->getDateValid()->format("Y-m-d") . "</th>";
            echo "<th>
                    <a type='button' class='btn btn-danger' href='/discount/delete/$id'>Invalidate</a>
                  </th>";
            echo "</tr>";
        }
    }

    public function create()
    {
        if ($_SESSION['userLoggedIn'] == null || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have access to this", "/");
        }
        
        $this->_render("createDiscount");
    }

    public function createPOST($post)
    {
        $validation = DiscountValidation::DiscountValidation($post);
        if (!$validation[0])
        {
            return $this->redirectWithPersistance($validation[1], "createDiscount");
        }

        if ($post->date < (new DateTime)->format('Y-m-d'))
        {
            return $this->redirectWithPersistance("ValidBy must be in the future", "createDiscount");
        }

        $discount = (new DiscountQuery)->findOneByCode($post->code);
        if ($discount != null)
        {
            return $this->redirectWithPersistance("Discount Code already in use, try another code", "createDiscount");
        }

        $this->discountService->createDiscount($post);
        $this->redirectWithMessage("Discount Created", "/discount");
    }

    public function delete($id)
    {
        $discount = (new DiscountQuery)->findOneByDiscountId($id);
        if ($discount == null)
        {
            $this->redirectWithMessage("Discount does not exist", "/discount");
        }

        $this->discountService->invalidateDiscount($id);
        $this->redirectWithMessage("Discount Invalidated", "/discount");
    }

    public function applyDiscount($post)
    {
        $validation = DiscountValidation::ApplyDiscountValidation($post);

        if (!$validation[0])
        {
            return $this->redirectWithPersistance($validation[1], "/basket");
        }

        $discount = $this->discountService->GetDiscountByCode($post->discount);

        if ($discount == null) 
        {
            return $this->redirectWithPersistance("Code does not exist", "basket");
        }

        if (!$discount->getValid())
        {
            return $this->redirectWithPersistance("Discount no longer valid", "basket");
        }

        if ($discount->getDateValid() < new DateTime())
        {
            return $this->redirectWithPersistance("Discount has expired", "basket");
        }

        $_SESSION['discount'] = $discount;
        $this->redirectWithMessage("Discount applied!", "/basket");
    }
}