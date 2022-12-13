<?php

namespace UF1\Controllers;

use stdClass;
use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;
use UF1\Models\Activity;

/**
 * Class ActivityController
 * @package UF1\Controllers
 */
class ActivityController
{
    /**
     * Metodo que crea una actividad, recoge los datos del formulario POST
     * los valida y crea la actividad
     * Tambien se encarga de guardar el error y guardar la actividad en la sesion del usuario
     * @redirect index.php
     * FORM @POST ?controller_option=ActivityController&method_option=create
     */
    public function create(){
        session_start();

        $title = $_POST['title-activity'] ?? null;
        $date = $_POST['date-activity'] ?? null;
        $city = $_POST['city-activity'] ?? null;
        $type = ActivityType::tryFrom($_POST['type-activity']) ?? null;
        $paymentMethod = ActivityPaymentMethod::tryFrom($_POST['paymentMethod-activity']) ?? null;
        $description = $_POST['description-activity'] ?? null;

        if(!(empty($title) || empty($date) || empty($city) || empty($type) || empty($paymentMethod) || empty($description))) {
            $json = new stdClass();
            $json->user_id = $_SESSION['user']['id'];
            $json->title = $title;
            $json->date = $date;
            $json->city = $city;
            $json->type = $_POST['type-activity'];
            $json->paymentMethod = $_POST['paymentMethod-activity'];
            $json->description = $description;
            $json = json_encode($json);

            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/activities-generator-api/index.php';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($httpCode == 201){
                $_SESSION['user']['activities'][] = $response;
            }
            else if($httpCode == 400){
                $_SESSION['errors']['activity']['create'] = $response->error;
            }
            else{
                $_SESSION['errors']['activity']['create'] = 'Error al crear la actividad';
            }
        }

        HomeController::index();
    }

    /**
     * Metodo que borra una actividad, recoge el id de la actividad por GET y la borra
     * Tambien se encarga de guardar el error y eliminar la actividad de la sesion del usuario
     * @redirect index.php
     * link <a> @GET ?controller_option=ActivityController&method_option=delete&id=1
     */
    public function delete(){
        session_start();

        $id = $_GET['id'] ?? null;

        if(!empty($id)){
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/activities-generator-api/index.php?id=' . $id;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "DELETE",
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($httpCode == 200){
                $_SESSION['user']['activities'] = array_filter($_SESSION['user']['activities'], function($activity) use ($id){
                    return $activity->id != $id;
                });
            }
            else if($httpCode == 400){
                $_SESSION['errors']['activity']['delete'] = $response->error;
            }
            else{
                $_SESSION['errors']['activity']['delete'] = 'Error al borrar la actividad';
            }

        }
        HomeController::index();
    }

    /**
     * Metodo que edita una actividad, recoge los datos del formulario POST
     * los valida y edita la actividad
     * Tambien se encarga de guardar el error y editar la actividad en la sesion del usuario
     * @redirect index.php
     * FORM @POST ?controller_option=ActivityController&method_option=update
     */
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
            $json = new stdClass();
            $json->title = $title;
            $json->date = $date;
            $json->city = $city;
            $json->type = $_POST['type-activity'];
            $json->paymentMethod = $_POST['paymentMethod-activity'];
            $json->description = $description;
            $json = json_encode($json);

            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/activities-generator-api/index.php?id=' . $id;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($httpCode == 200){
                $_SESSION['user']['activities'] = array_map(function($activity) use ($id,$response){
                    return $activity->id == $id ? $response : $activity;
                }, $_SESSION['user']['activities']);
            }
            else if($httpCode == 400){
                $_SESSION['errors']['activity']['update'] = $response->error;
            }
            else{
                $_SESSION['errors']['activity']['update'] = 'No se ha podido actualizar la actividad';
            }
        }

        HomeController::index();
    }
}
