<?php

use UF1\Controllers\ActivityController;
use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;

require_once realpath('vendor/autoload.php');

session_start();

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
        $_SESSION['activities'][] = $activityController->create($title, $date, $city, $type, $paymentMethod, $description);
    }
}

?>

<html>
    <head>
        <title>Activities-Generator</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="./assets/css/styles.css">
    </head>
    <body>
        <header>
            <?php require_once realpath('views/layout/header.php'); ?>
        </header>
        <?php
            if(empty($_SESSION['user'])){
                require_once realpath('views/login.php');
            }
            else{
                require_once realpath('views/activities.php');
            }
        ?>
    </body>
</html>

