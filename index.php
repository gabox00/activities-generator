<?php

use UF1\Controllers\ActivityController;
use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;

require_once realpath('vendor/autoload.php');

if(isset($_POST['activitityCreated'])){
    $title = $_POST['title-activity'] ?? null;
    $date = $_POST['date-activity'] ?? null;
    $city = $_POST['city-activity'] ?? null;
    $type = ActivityType::tryFrom($_POST['type-activity']) ?? null;
    $paymentMethod = ActivityPaymentMethod::tryFrom($_POST['paymentMethod-activity']) ?? null;
    $description = $_POST['description-activity'] ?? null;

    if(empty($title) || empty($date) || empty($city) || empty($type) || empty($paymentMethod) || empty($description)) {
        $activity = null;
    }
    else{
        $activityController = new ActivityController();
        $activity = $activityController->create($title, $date, $city, $type, $paymentMethod, $description);
    }
}
?>

<html>
    <head>
        <title>Activities-Generator</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="h-100 d-flex justify-content-<?=!empty($activity) ? 'around' : 'center'?> align-items-center ">
                <div>
                    <?php if(!empty($activity)): ?>
                        <h3>Actividades</h3>
                        <div class="card" style="width: 18rem;">
                            <img src="./assets/img/<?=$_POST['type-activity']?>" class="card-img-top" alt="<?=$_POST['type-activity']?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$activity->title?></h5>
                                <p class="card-text"><?=$activity->description?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><label>Fecha:   <b><?=$activity->date?></b></label></li>
                                <li class="list-group-item"><label>Ciudad:   <b><?=$activity->city?></b></label></li>
                                <li class="list-group-item"><label>Tipo:   <b><?=$_POST['type-activity']?></b></label></li>
                                <li class="list-group-item"><label>Método de pago:   <b><?=$_POST['paymentMethod-activity']?></b></label></li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
                <div>
                    <h3>Crear Actividad</h3>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="title-activity" class="form-label">Título</label>
                            <input type="text" id="title" name="title-activity" class="form-control" placeholder="Titulo" value="<?=$activity->title ?? ''?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="date-activity" class="form-label">Fecha</label>
                            <input type="date" id="date" name="date-activity" class="form-control" placeholder="Fecha" value="<?=$activity->date ?? ''?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="city-activity" class="form-label">Ciudad</label>
                            <input type="text" id="city" name="city-activity" class="form-control" placeholder="Ciudad" value="<?=$activity->city ?? ''?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="type-activity" class="form-label">Tipo</label>
                            <select id="type" name="type-activity" class="form-select" required>
                                <?php foreach (ActivityType::cases() as $activityType): ?>
                                    <option value="<?= $activityType->value ?>"><?= ucfirst($activityType->value) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMethod-activity" class="form-label">Método de pago</label>
                            <select id="paymentMethod" name="paymentMethod-activity" class="form-select" required>
                                <?php foreach (ActivityPaymentMethod::cases() as $paymentMethod): ?>
                                    <option value="<?= $paymentMethod->value ?>"><?= ucfirst($paymentMethod->value) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description-activity" class="form-label">Descripción</label>
                            <textarea id="description" name="description-activity" class="form-control" placeholder="Descripción"><?=$activity->description ?? ''?></textarea>
                        </div>
                        <button type="submit" name="activitityCreated" class="btn btn-primary mt-2">Crear Actividad</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

