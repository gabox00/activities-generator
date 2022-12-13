<?php

use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;

?>
<!--Muestra las actividades del usuario y tambien se encuentra el formulario de eliminacion y actualizacion de las actividades-->
<div>
    <?php if(!empty($_SESSION['user']['activities'])): ?>
        <h3>Actividades</h3>
        <div class="cards">
            <?php foreach($_SESSION['user']['activities'] as $activity):?>
                <form action="?controller_option=ActivityController&method_option=update" method="post">
                    <div class="card">
                        <div class="img-wraps">
                            <a href="?controller_option=ActivityController&method_option=delete&id=<?=$activity->id?>" class="closes" title="Delete">×</a>
                            <img src="./assets/img/<?=$activity->type?>" class="card-img-top" alt="<?=$activity->type?>">
                        </div>
                        <div class="card-body">
                            <label for="title-activity" class="w-100">
                                Titulo:
                                <input type="text" id="title" name="title-activity" style="font-weight: bold;" class="card-title border-0"  value="<?=$activity->title?>">
                            </label>
                            <label for="description-activity" class="w-100">
                                Descripción:
                                <input type="text" id="description" name="description-activity" style="font-weight: bold;" class="card-text border-0" value="<?=$activity->description?>">
                            </label>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <label for="date-activity">Fecha:   </label>
                                <input type="date" id="date" name="date-activity" style="font-weight: bold;" class="card-title border-0" value="<?=$activity->date?>">
                            </li>
                            <li class="list-group-item">
                                <label for="city-activity">Ciudad:   </label>
                                <input type="text" id="city" name="city-activity" style="font-weight: bold;" class="card-title border-0" value="<?=$activity->city?>">
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <label for="type-activity">Tipo:</label>
                                <select id="type" name="type-activity" class="form-select border-0 w-25" style="font-weight: bold;" required>
                                    <?php foreach (ActivityType::cases() as $activityType): ?>
                                        <option value="<?= $activityType->value ?>" <?= $activityType->value == $activity->type ? 'selected' : '' ?>><?= ucfirst($activityType->value) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <label for="paymentMethod-activity">Método de pago:</label>
                                <select id="paymentMethod" name="paymentMethod-activity" class="form-select border-0 w-25" style="font-weight: bold;" required>
                                    <?php foreach (ActivityPaymentMethod::cases() as $paymentMethod): ?>
                                        <option value="<?= $paymentMethod->value ?>" <?= $paymentMethod->value == $activity->paymentMethod ? 'selected' : '' ?>><?= ucfirst($paymentMethod->value) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                        </ul>
                        <button type="submit" name="update_activity" class="btn btn-warning">Actualizar</button>
                        <input type="hidden" name="activity_id" value="<?=$activity->id?>">
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
</div>