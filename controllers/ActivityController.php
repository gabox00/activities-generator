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
            $activity = $activity->save();
            $activity
                ? $_SESSION['user']['activities'][] = $activity
                : $_SESSION['errors']['activity']['create'] = 'No se ha podido crear la actividad';
        }

        HomeController::index();
    }

    public function delete(){
        session_start();

        $id = $_GET['id'] ?? null;

        if(!empty($id)){
            $activityModel = new Activity();
            $activity = $activityModel->getActivityById($id);
            if($activity){
                $activity->delete()
                    ? $_SESSION['user']['activities'] = array_filter($_SESSION['user']['activities'], function($activity) use ($id){
                        return $activity->getId() != $id;
                    })
                    : $_SESSION['errors']['activity']['delete'] = 'No se ha podido eliminar la actividad';
            }
        }
        HomeController::index();
    }

    public function update(){
        session_start();

        $id = $_POST['activity_id'] ?? null;
        $title = $_POST['title-activity'] ?? null;
        $date = $_POST['date-activity'] ?? null;
        $city = $_POST['city-activity'] ?? null;
        $type = ActivityType::tryFrom($_POST['type-activity']) ?? null;
        $paymentMethod = ActivityPaymentMethod::tryFrom($_POST['paymentMethod-activity']) ?? null;
        $description = $_POST['description-activity'] ?? null;

        if(!(empty($id) || empty($title) || empty($date) || empty($city) || empty($type) || empty($paymentMethod) || empty($description))) {
            $activity = new Activity();
            $activity = $activity->getActivityById($id);
            $activity->setTitle($title);
            $activity->setDate($date);
            $activity->setCity($city);
            $activity->setType($type);
            $activity->setPaymentMethod($paymentMethod);
            $activity->setDescription($description);
            $activityUpdated = $activity->update();
            $activityUpdated
                ? $_SESSION['user']['activities'] = array_map(function($activity) use ($id,$activityUpdated){
                    return $activity->getId() == $id ? $activityUpdated : $activity;
                }, $_SESSION['user']['activities'])
                : $_SESSION['errors']['activity']['update'] = 'No se ha podido actualizar la actividad';
        }

        HomeController::index();
    }
}
