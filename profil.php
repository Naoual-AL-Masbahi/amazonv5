<?php
require "database/database.php";
require "helpers/functions.php";

if (!isset($_SESSION['auth_amazonv5'])) {
    $_SESSION['message'] =  "Vous n'avez pas les autorisations pour afficher cette page";
    $_SESSION['color'] = "danger";
    header('Location:login.php');
    exit;
} else {
    $user_auth = $_SESSION['auth_amazonv5'];
}

// var_dump($_SESSION['auth_amazonv5']);
// exit;


?>

<!doctype html>
<html lang="en">

<head>
    <title>Profil</title>
    <?php include "body/head.php"; ?>
    <?php include "body/scripts.php"; ?>

</head>

<body>
    <header>
        <!-- place navbar here -->

        <?php include "body/nav.php"; ?>
    </header>
    <main class="container mt-3">
        <?php include_once "body/message_flash.php" ?>
        <?php include_once "body/message_error.php" ?>

        <h1>Profil</h1>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>