 <div class='container'>
    <form method='POST' action='/product/create'>
        <div class='mb-3'>
            <label for='ProductName' class='form-label'>Product Name</label>
            <input type='text' class='form-control' id='ProductName' aria-describedby='ProductName' name='ProductName' value="<?php echo Shop\Controllers\BaseController::retainPostValue('ProductName') ?>">
        </div>

        <div class='mb-3'>
            <label for='ProductDescription' class='form-label'>Product Description</label>
            <input type='text' class='form-control' id='ProductDescription' aria-describedby='ProductDescription' name='ProductDescription' value="<?php echo Shop\Controllers\BaseController::retainPostValue('ProductDescription') ?>">
        </div>

        <div class='mb-3'>
            <label for='Category' class='form-label'>Category</label>
            <input type='text' class='form-control' id='Category' aria-describedby='Category' name='Category' value="<?php echo Shop\Controllers\BaseController::retainPostValue('Category') ?>">
        </div>

        <div class='mb-3'>
            <label for='Quantity' class='form-label'>Quantity</label>
            <input type='text' class='form-control' id='Quantity' aria-describedby='Quantity' name='Quantity' value="<?php echo Shop\Controllers\BaseController::retainPostValue('Quantity') ?>">
        </div>

        <div class='mb-3'>
            <label for='Price' class='form-label'>Price</label>
            <input type='Price' class='form-control' id='Price' name='Price' value="<?php echo Shop\Controllers\BaseController::retainPostValue('Price') ?>">
        </div>

        <button type='submit' class='btn btn-primary'>Submit</button>
    </form>
</div>