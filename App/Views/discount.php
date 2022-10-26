<?php

use Shop\Controllers\DiscountController;
use Shop\Service\DiscountService;
$discounts = (new DiscountService)->getDiscounts();

?>

<a type="button" class="btn btn-primary" href="/discount/create">Create Discount</a>

<table class="table table-striped">
<thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Discount Percentage</th>
      <th scope="col">Date Valid</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php DiscountController::renderDiscount($discounts); ?>
  </tbody>
</table>

