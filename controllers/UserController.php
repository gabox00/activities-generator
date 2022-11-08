<?php

namespace UF1\Controllers;

class UserController{

    public function register(){
        return null;
    }

    public function login(){
        session_start();
        $username = $_POST['user_username'];
        $password = $_POST['user_password'];
        if($username == 'ifp' && $password == '2022') {
            $_SESSION['user'] = [
                'username' => $username,
                'activities' => []
            ];
            unset($_SESSION['errors']['user']['login']);
        }
        else{
            $_SESSION['errors']['user']['login'] = 'Usuario o password incorrectos';
        }
        HomeController::index();
    }

    public function logout(){
        session_start();
        unset($_SESSION['user']);
        HomeController::index();
    }
}