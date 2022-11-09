<div class="container">
    <div>
        <?php if(!empty($_SESSION['errors']['user']['register'])): ?>

            <?php if(is_array($_SESSION['errors']['user']['register'])): ?>
                <?php foreach ($_SESSION['errors']['user']['register'] as $error): ?>
                <div class="mt-4">
                    <div class="alert alert-danger mt-1" role="alert">
                        <?= $error; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-danger mt-5" role="alert">
                    <?= $_SESSION['errors']['user']['register']; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
    <div class="login-form h-100 d-flex justify-content-center <?=empty($_SESSION['errors']['user']['register']) ? 'align-items-center' : ''?>">
        <form action="?controller_option=UserController&method_option=register" method="post">
            <h2 class="text-center mb-3">Register</h2>
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required="required">
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>
    </div>
</div>