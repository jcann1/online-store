<div class="container">
    <form method="POST" action="/login">
        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="<?php echo Shop\Controllers\BaseController::retainPostValue('username') ?>">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/twitter/authorize/login">Login using Twitter</a>
    </form>
</div>