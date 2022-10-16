<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
    <div>
        <a class="navbar-brand" href="index.php" style="margin-left: 10px">IFP DAW</a>
    </div>
    <?php if(!empty($_SESSION['user'])): ?>
        <div class="d-flex align-items-center">
            <b style="padding-right: 1rem"><?= $_SESSION['user'] ?></b>
            <form class="form-inline my-2 my-lg-0" style="padding-right: 0.5rem" action="./controllers/UserController.php" method="post">
                <div class="form-group">
                    <button type="submit" name="user_logout" class="btn btn-primary btn-block">Log out</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</nav>