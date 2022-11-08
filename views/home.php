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
empty($_SESSION['user'])
    ? require_once realpath('views/login.php')
    : require_once realpath('views/activities.php');
?>
</body>
</html>