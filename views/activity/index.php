<div class="container">
    <div>
        <!--    Pintamos cualquier error del CRUD de la actividad    -->
        <?php if(!empty($_SESSION['errors']['activity'])): ?>
            <?php foreach ($_SESSION['errors']['activity'] as $error): ?>
                <div class="mt-4">
                    <div class="alert alert-danger mt-1" role="alert">
                        <?= $error[0]; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="h-100 d-flex justify-content-<?=!empty($_SESSION['user']['activities']) ? 'around' : 'center'?> align-items-center ">
        <!--    Incluimos las vistas    -->
        <?php require_once("update.php") ?>
        <?php require_once("create.php") ?>
    </div>
</div>