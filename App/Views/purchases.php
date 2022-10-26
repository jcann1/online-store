<?php
use Shop\Controllers\PurchaseController;
?>

<h1>Purchases Page</h1>

<div class='table-responsive'>
<table class='table'>
    <thead>
        <tr>
        <th scope='col'>Purchase Id</th>
        <th scope='col'>Order Status</th>
        <th scope='col'>View Ordered Products</th>
        </tr>
    </thead>
    <tbody>
       <?php PurchaseController::renderUserPurchases($_SESSION['userLoggedIn']); ?>
    </tbody>
</table>
</div>