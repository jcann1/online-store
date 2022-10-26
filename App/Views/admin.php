<?php 

use Shop\Controllers\AdminController;
use Shop\Models\PurchaseQuery;

$totalPurchases = PurchaseQuery::create()->count();

?>
<h1>Admin Page</h1>

<h2>All Purchases</h2>

<p>Total Purchases: <?php echo $totalPurchases ?></p>

<div class='table-responsive my-3'>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th scope='col'>Purchase Id</th>
                <th scope='col'>User Id</th>
                <th scope='col'>Purchase Status</th>
            </tr>
        </thead>
        <tbody>
            <?php (new AdminController)->RenderAllPurchases(); ?>
        </tbody>
    </table>
</div>

<h2>All Users</h2>

<div class='table-responsive my-3'>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th scope='col'>User ID</th>
                <th scope='col'>Username</th>
                <th scope='col'>User Level</th>
                <th scope='col'>Edit User</th>
            </tr>
        </thead>
        <tbody>
            <?php (new AdminController)->RenderAllUsers(); ?>
        </tbody>
    </table>
</div>