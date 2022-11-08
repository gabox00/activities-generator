<div class="container">
    <div>
        <?php if(!empty($_SESSION['errors']['user']['register'])): ?>
            <div class="alert alert-danger mt-5" role="alert">
                <?= $_SESSION['errors']['user']['register']; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="login-form h-100 d-flex justify-content-center <?=empty($_SESSION['errors']['user']['register']) ? 'align-items-center' : ''?>">
        <form action="?controller_option=UserController&method_option=register" method="post">
            <h2 class="text-center mb-3">Register</h2>
            <div class="form-group mb-3">
                <input type="email" name="user_email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group mb-3">
                <input type="text" name="user_name" class="form-control" placeholder="Name" required="required">
            </div>
            <div class="form-group mb-3">
                <input type="password" name="user_password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="user_register" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>
    </div>
</div>