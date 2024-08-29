<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['auth_amazonv5'])) {
    unset($_SESSION['auth_amazonv5']);
}

header("Location:login.php");
exit;
