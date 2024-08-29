<?php



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define("PROJECT_NAME", "amazonv");

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
}

// $price = "24 599,99";
// $price = 24599.99;

// echo number_format($price, 2, ',', ' ');
// exit;


function _number_format($number)
{
    return number_format($number, 2, ',', ' ');
}

function _get_purcentage(float $number, int $purcentage = 20): float | string
{
    if ($purcentage > 100 || $purcentage < 0) {
        return "Error";
    }
    return ($number * $purcentage) / 100;
}

function _check_if_user_connected()
{
    if (!isset($_SESSION['auth_amazonv5'])) {
        $_SESSION['message'] =  "Vous n'avez pas le droit de consulter cette page";
        $_SESSION['color'] = "danger";
        header('Location:login.php');
        exit;
    }
}

function auth(): bool
{
    if (!isset($_SESSION['auth_amazonv5'])) {
        return false;
    }
    return true;
}

function e($value)
{
    return htmlspecialchars(trim(strtolower($value)));
}