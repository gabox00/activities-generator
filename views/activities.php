<?php

use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;

?>

<div class="container">
    <div class="h-100 d-flex justify-content-<?=!empty($_SESSION['activities']) ? 'around' : 'center'?> align-items-center ">
        <div>
            <?php if(!empty($_SESSION['activities'])): ?>
                <h3>Actividades</h3>
                <div class="cards">
                    <?php foreach($_SESSION['activities'] as $activity):?>
                        <div class="card">
                            <img src="./assets/img/<?=$activity->type->value?>" class="card-img-top" alt="<?=$activity->type->value?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$activity->title?></h5>
                                <p class="card-text"><?=$activity->description?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><label>Fecha:   <b><?=$activity->date?></b></label></li>
                                <li class="list-group-item"><label>Ciudad:   <b><?=$activity->city?></b></label></li>
                                <li class="list-group-item"><label>Tipo:   <b><?=$activity->type->value?></b></label></li>
                                <li class="list-group-item"><label>Método de pago:   <b><?=$activity->paymentMethod->value?></b></label></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
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