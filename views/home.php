<?php
session_start();
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

if(isset($_SESSION['user']['register'])) {
    require_once realpath('views/user/register.php');
    unset($_SESSION['user']);
}
else {
    empty($_SESSION['user'])
        ? require_once realpath('views/user/login.php')
        : require_once realpath('views/activity/index.php');
}

?>
</body>
</html>