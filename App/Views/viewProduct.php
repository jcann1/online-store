<h1>Purchased Products Page</h1>

<div class='table-responsive'>
    <table class='table'>
        <thead>
            <tr>
                <th scope='col'>Name</th>
                <th scope='col'>Description</th>
                <th scope='col'>Price</th>
                <th scope='col'>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php Shop\Controllers\PurchaseController::renderViewProducts($_SESSION["purchaseId"]); ?>
        </tbody>
    </table>
</div>