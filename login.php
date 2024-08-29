<?php
require "database/database.php";
require "helpers/functions.php";


// "SELECT * FROM users 
// WHERE 
// email = 'ayoub@gmail.com' and password = '' 
// or 
// '1'='1'
// "

// ' or ''='






if (isset($_SESSION['auth_amazonv5'])) {
    $_SESSION['message'] =  "Vous êtes déjà connecté";
    $_SESSION['color'] = "danger";
    header('Location:dashboard.php');
    exit;
}
$errors = [];
if (isset($_POST['btn_login'])) {

    // 1- chek if all input existe
    if (isset($_POST['email'], $_POST['password'])) {

        // Validation inputs data
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email == '') {
            // Error
            $input_email_class = 'is-invalid';
            $input_email_message = 'Le champ email est requis';
            $errors[] = $input_email_message;
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $input_email_class = 'is-invalid';
                $input_email_message = "Format d'email invalide";
                $errors[] = $input_email_message;
            } else {
                $email_rows = $db->query("SELECT * FROM users WHERE email = '$email' LIMIT 1")->rowCount();
                if ($email_rows == 0) {
                    $input_email_class = '';
                    $input_email_message = "";
                    $errors[] =  "Email ou mot de passe incorrecte";
                } else {
                    $input_email_class = 'checked';
                }
            }
        }

        if ($password == '') {
            // Error
            $input_password_class = 'is-invalid';
            $input_password_message = 'Le champ mot de passe est requis';
            $errors[] = $input_password_message;
        } else {
            $input_password_class = '';
        }


        // Check if email in database
        if ($input_email_class == 'checked') {

            $user = $db->query("SELECT * FROM users WHERE email = '$email' LIMIT 1")->fetch();

            $password_hash = $user->password;
            // var_dump(password_verify($password, $password_hash));
            // exit;
            // Verify password 

            if (!password_verify($password, $password_hash)) {
                $input_password_class = '';
                $input_password_message = '';
                $errors[] = "Email ou mot de passe incorrecte";
            } else {

                // Save curent user to seesion


                $_SESSION['auth_amazonv5'] =  $user;

                // var_dump($_SESSION['auth_amazonv5']);
                // exit;


                // redirect user to dashboard page and show message confirm
                $_SESSION['message'] =  "Bien connecter";
                $_SESSION['color'] = "success";
                header('Location:dashboard.php');
                exit;
            }
        }
    } else {
        $_SESSION['message'] =  "Veuillez remplire toutes les champs SVP !!!";
        $_SESSION['color'] = "danger";
        header('Location:login.php');
        exit;
    }
}

if (isset($_POST['btn_login2'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_rows = $db->query("SELECT * FROM users WHERE email = '$email' and password = '$password'")->rowCount();

    if ($user_rows > 0) {
        echo "Bien connecter";
    } else {
        echo "Email ou mot de passe incorrecte";
    }

    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
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

        <div class="row justify-content-md-center ">
            <div class="col-8">

                <div class="bg-light p-5 rounded-pilla rounded-3">

                    <h3 class="text-center mb-4">
                        SE CONNECTER
                    </h3>


                    <h5 class="text-center">
                        Clients enregistrés
                    </h5>
                    <p class="text-center">
                        Si vous avez un compte, connectez-vous avec votre adresse email.
                    </p>


                    <form method="post">

                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Adresse mail:</label>

                            <input name="email" type="text" class="form-control 
                            <?= $input_email_class ?? '' ?>" id=" email" placeholder="Veuillez saisir votre email SVP !" value="<?= $email ?? '' ?>">
                            <div class="invalid-feedback">
                                <?= $input_email_message ?? '' ?>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Mot de passe:</label>

                            <input name="password" type="password" class="form-control 
                            <?= $input_password_class ?? '' ?>" id=" password" placeholder="Veuillez saisir votre Mot de passe SVP !" value="<?= $password ?? '' ?>">
                            <div class="invalid-feedback">
                                <?= $input_password_message ?? '' ?>
                            </div>

                        </div>


                        <div class="d-flex mb-3">
                            <div class="me-auto p-2">
                                <button type="submit" class="btn btn-dark" name="btn_login">
                                    Connexion
                                </button>
                            </div>
                            <div class="p-2">
                                <a href="forgot-password.html" class="text-dark">
                                    Mot de passe oublier:
                                </a>
                            </div>
                        </div>

                    </form>


                    <h5 class="text-center mt-4">Nouveaux clients</h5>


                    <hr>

                    <p class="text-center">
                        La création d’un compte a de nombreux avantages : consultation rapide, sauvegarder plusieurs
                        adresses, suivre les commandes, et bien plus encore.
                    </p>

                    <div class="d-flex justify-content-center">
                        <a href="register.html" class="btn btn-dark text-white mt-4 text-center">Créer un compte</a>
                    </div>
                </div>
            </div>

        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>