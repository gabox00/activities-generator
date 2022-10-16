<?php

namespace UF1\Controllers;

session_start();

if(isset($_POST['user_login'])){
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
    header('Location: ../index.php');
}
else if(isset($_POST['user_logout'])){
    unset($_SESSION['user']);
    header('Location: ../index.php');
}