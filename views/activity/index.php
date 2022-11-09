<div class="container">
    <div class="h-100 d-flex justify-content-<?=!empty($_SESSION['user']['activities']) ? 'around' : 'center'?> align-items-center ">
        <?php require_once("update.php") ?>
        <?php require_once("create.php") ?>
    </div>
</div>