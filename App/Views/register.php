<div class="container">
    <form method="POST" action="/register">
        <div class="mb-3">
            <label for="forename" class="form-label">Forename</label>
            <input type="text" class="form-control" id="forename" aria-describedby="forename" name="forename" value="<?php echo Shop\Controllers\BaseController::retainPostValue('forename') ?>">
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" aria-describedby="surname" name="surname" value="<?php echo Shop\Controllers\BaseController::retainPostValue('surname') ?>">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="<?php echo Shop\Controllers\BaseController::retainPostValue('username') ?>">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" aria-describedby="password" name="password" >
        </div>

        <div class="mb-3">
            <label for="password2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password2" name="password2">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>