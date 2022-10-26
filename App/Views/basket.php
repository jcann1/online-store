<?php

use Shop\Controllers\BasketController;
use Shop\Service\BasketService;

$basket = json_decode(BasketController::GetCookie("basket"));

if (count((array)$basket) == 0) {
  echo "Your basket is empty";
  return;
}

$products = (new BasketService)->getProductsOnBasket($basket);

?>

<table class="table table-striped mx-4">
<thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Cost</th>
      <th scope="col">Quantity</th>
      <th scope="col">Sub-Total</th>
    </tr>
  </thead>
  <tbody>
      <?php BasketController::renderProductsInBasketTable($products); ?>
  </tbody>
</table>

<?php 

$total = 0;

foreach($products as $product) 
{
  $total = $total + $product['subtotal'];
}

if (!isset($_SESSION['discount'])) 
{
  $prettyTotal = BasketController::DoubleToCurrency($total);
  echo "<div class='mx-4'>Total Price: <b>$prettyTotal</b></div>";
  BasketController::renderDiscountForm();
}
else
{
  $discount = $_SESSION['discount'];
  $code = $discount->getCode();
  $discountedTotal = BasketController::calculateTotalWithDiscount($discount, $total);
  $prettyTotal = BasketController::DoubleToCurrency($total);
  $prettyDiscountedTotal = BasketController::DoubleToCurrency($discountedTotal);

  echo "<p>Your discount code <b>$code</b> is applied!";
  echo "<p>Total without discount <b>$prettyTotal</b><p>";
  echo "<p>Total with discount <b>$prettyDiscountedTotal</b></p>";
}
?>

<div class="form-container">
<form action='/purchase/order' method='post'>
  <div class="mb-3">
    <label for="username" class="form-label">Forename</label>
    <input type="text" class="form-control" id="forename" aria-describedby="forename" name="forename" value="<?php echo Shop\Controllers\BaseController::retainPostValue('forename') ?>">
  </div>

  <div class="mb-3">
    <label for="username" class="form-label">Surname</label>
    <input type="text" class="form-control" id="surname" aria-describedby="surname" name="surname" value="<?php echo Shop\Controllers\BaseController::retainPostValue('surname') ?>">
  </div>
  
  <div class="mb-3">
    <label for="username" class="form-label">Email</label>
    <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="<?php echo Shop\Controllers\BaseController::retainPostValue('username') ?>">
  </div>
  
  <div class="mb-3">
    <label for="username" class="form-label">Address 1</label>
    <input type="text" class="form-control" id="address1" aria-describedby="address1" name="address1" value="<?php echo Shop\Controllers\BaseController::retainPostValue('address1') ?>">
  </div>

  <div class="mb-3">
    <label for="username" class="form-label">Address 2</label>
    <input type="text" class="form-control" id="address2" aria-describedby="address2" name="address2" value="<?php echo Shop\Controllers\BaseController::retainPostValue('address2') ?>">
  </div>

  <div class="mb-3">
    <label for="username" class="form-label">City</label>
    <input type="text" class="form-control" id="city" aria-describedby="city" name="city" value="<?php echo Shop\Controllers\BaseController::retainPostValue('city') ?>">
  </div>

  <div class="mb-3">
    <label for="username" class="form-label">Postcode</label>
    <input type="text" class="form-control" id="postcode" aria-describedby="postcode" name="postcode" value="<?php echo Shop\Controllers\BaseController::retainPostValue('postcode') ?>">
  </div>

  <div class="mb-3">
    <label for="username" class="form-label">Telephone</label>
    <input type="text" class="form-control" id="telephone" aria-describedby="telephone" name="telephone" value="<?php echo Shop\Controllers\BaseController::retainPostValue('telephone') ?>">
  </div>
  
  <button type='submit' class='btn btn-primary'>Place Order</button>
</form>
</div>