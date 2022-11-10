<!--Formulario de login del usuario-->
<div class="container">
    <!--  Se muestran los errores de login del usuario  -->
    <div>
        <?php if(!empty($_SESSION['errors']['user']['login'])): ?>
            <div class="alert alert-danger mt-5" role="alert">
                <?= $_SESSION['errors']['user']['login']; ?>
            </div>
        <?php endif; ?>
    </div>
    <!--Formulario-->
    <div class="login-form h-100 d-flex justify-content-center <?=empty($_SESSION['errors']['user']['login']) ? 'align-items-center' : ''?>">
        <form action="?controller_option=UserController&method_option=login" method="post">
            <h2 class="text-center mb-3">Log in</h2>
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
                <a href="?controller_option=RegisterController&method_option=index" class="btn btn-dark btn-block">Register</a>
            </div>
        </form>
    </div>
</div>