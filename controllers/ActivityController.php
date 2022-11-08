<?php

namespace UF1\Controllers;

use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;
use UF1\Models\Activity;

class ActivityController
{
    public function create(){
        session_start();

        $title = $_POST['title-activity'] ?? null;
        $date = $_POST['date-activity'] ?? null;
        $city = $_POST['city-activity'] ?? null;
        $type = ActivityType::tryFrom($_POST['type-activity']) ?? null;
        $paymentMethod = ActivityPaymentMethod::tryFrom($_POST['paymentMethod-activity']) ?? null;
        $description = $_POST['description-activity'] ?? null;

        if(!(empty($title) || empty($date) || empty($city) || empty($type) || empty($paymentMethod) || empty($description))) {
            $activity = new Activity();
            $activity->setUserId($_SESSION['user']['id']);
            $activity->setTitle($title);
            $activity->setDate($date);
            $activity->setCity($city);
            $activity->setType($type);
            $activity->setPaymentMethod($paymentMethod);
            $activity->setDescription($description);
            $activity->save()
                ? $_SESSION['user']['activities'][] = $activity
                : $_SESSION['errors']['activity']['create'] = 'No se ha podido crear la actividad';
        }

        HomeController::index();
    }
}
