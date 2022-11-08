<div class="container">
    <div>
        <?php if(!empty($_SESSION['errors']['user']['login'])): ?>
            <div class="alert alert-danger mt-5" role="alert">
                <?= $_SESSION['errors']['user']['login']; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="login-form h-100 d-flex justify-content-center <?=empty($_SESSION['errors']['user']['login']) ? 'align-items-center' : ''?>">
        <form action="?controller_option=UserController&method_option=login" method="post">
            <h2 class="text-center mb-3">Log in</h2>
            <div class="form-group mb-3">
                <input type="text" name="user_username" class="form-control" placeholder="Username" required="required">
            </div>
            <div class="form-group mb-3">
                <input type="password" name="user_password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="user_login" class="btn btn-primary btn-block">Log in</button>
            </div>
        </form>
    </div>
</div>