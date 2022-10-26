<div class="container">
    <form method="POST" action="/discount/create">
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="<?php echo Shop\Controllers\BaseController::retainPostValue('code') ?>">
        </div>

        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage</label>
            <input type="text" class="form-control" id="percentage" name="percentage" value="<?php echo Shop\Controllers\BaseController::retainPostValue('percentage') ?>">
        </div>

        <div class="mb-3">
            <label for="date">Valid by</label>
            <duet-date-picker identifier="date" value="<?php echo Shop\Controllers\BaseController::retainPostValue('date') ?>"></duet-date-picker>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>