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
            $_SESSION['user']['activities'][] = new Activity($title, $date, $city, $type, $paymentMethod, $description);
        }
        HomeController::index();
    }
}
