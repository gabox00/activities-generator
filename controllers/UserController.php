<?php

namespace UF1\Controllers;
use UF1\Models\User;

/**
 * Class RegisterController
 * @package UF1\Controllers
 */
class UserController{

    /**
     * Metodo que se encarga de registrar un usuario en la base de datos
     * recoge los datos del formulario, los valida y registra el usuario en la base de datos
     * Tambien se encarga de guardar el error y guardar el usuario en la sesion
     * FORM @POST ?controller_option=UserController&method_option=register
     * @redirect index.php
     */
    public function register(){
        session_start();

        $email = $_POST['email'] ?? null;
        $name = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        $errors = [];

        //validar nombre
        if(empty($name) || is_numeric($name) || preg_match("/[0-9]/", $name)){
            $errors['nombre'] = 'El nombre no es válido';
        }

        //validar password
        if(empty($password)){
            $errors['password'] = 'El password no es válido';
        }

        //validar email
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'El email no es válido';
        }

        //Si hay errores de validacion
        if(!empty($errors)){
            $_SESSION['errors']['user']['register'] = $errors;
            $_SESSION['user']['register'] = true;
        }

        unset($_SESSION['user']['register']);
        unset($_SESSION['errors']['user']['register']);

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        if(!$user->save()){
            $_SESSION['errors']['user']['register'] = 'No se ha podido registrar el usuario';
            $_SESSION['user']['register'] = true;
        }

        if($user->login($user->getEmail(), $password)){
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'activities' => $user->getActivities()
            ];
            unset($_SESSION['errors']['user']['login']);
        }

        HomeController::index();

    }

    /**
     * Metodo que se encarga de loguear un usuario en la base de datos
     * recoge los datos del formulario, los valida y loguea el usuario en la base de datos
     * Tambien se encarga de guardar el error y guardar el usuario en la sesion
     * FORM @POST ?controller_option=UserController&method_option=login
     * @redirect index.php
     */
    public function login(){
        session_start();

        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $userModel = new User();
        if($user = $userModel->login($email, $password)){
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'activities' => $user->getActivities()
            ];
            unset($_SESSION['errors']['user']['login']);
        }
        else{
            $_SESSION['errors']['user']['login'] = 'Usuario o password incorrectos';
        }

        HomeController::index();
    }

    /**
     * Metodo que se encarga de cerrar la sesion del usuario
     * elimina la sesion del usuario y los errores en general
     * @redirect index.php
     */
    public function logout(){
        session_start();
        unset($_SESSION['user']);
        unset($_SESSION['errors']);
        HomeController::index();
    }
}