<?php
require "database/database.php";
require "helpers/functions.php";

if (isset($_SESSION['auth_amazonv5'])) {
    $_SESSION['message'] =  "Vous êtes déjà connecté";
    $_SESSION['color'] = "danger";
    header('Location:dashboard.php');
    exit;
}
// $password_input = 123456;
// $password_db = password_hash($password_input, PASSWORD_BCRYPT);

// // $password_db = '$2y$10$WrFUeV8wSjMzXebL5oEHxeB3cE2rW/KOEL57zJO6EJRgP3W3yS6G.';
// echo $password_db;
// echo "<br>";
// if (password_verify($password_input, $password_db)) {
//     echo "Bien connecter";
// } else {
//     echo "Email ou mot de pass incorrecte";
// }

// exit;
// echo password_hash($password_input, 3);
// var_dump(password_hash($password_input, PASSWORD_BCRYPT));

// exit;

// $test = [];
// $test[] = "Test 1";
// $test[] = "Test 2";
// $test[] = "Ayoub";
// echo "<pre>";
// print_r($test);
// echo "</pre>";
// exit;

// $prenom = 'el amrani';
// preg_match('/^[a-zA-Z]+$/', $prenom);

// echo "<pre>";
// print_r(!preg_match('/^[a-zA-Z ]+$/', $prenom));
// echo "</pre>";
// exit;


// $_SESSION['message'] = "Bien ajouter un utilisateur";
// unset($_SESSION['message']);
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// exit;

// $input_prenom_class = $input_prenom_message = '';
$errors = [];

if (isset($_POST['register_btn'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit;
    if (isset($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['password'], $_POST['password_confirm'])) {

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        if ($prenom == '') {
            // Error
            $input_prenom_class = 'is-invalid';
            $input_prenom_message = 'Le champ prénom est requis';
            $errors[] = $input_prenom_message;
        } else {
            if (strlen($prenom) < 3) {
                // Error
                $input_prenom_class = 'is-invalid';
                $input_prenom_message = 'Veuillez saisir plus de 3 caractères';
                $errors[] = $input_prenom_message;
            } else {
                // Succcess
                if (!preg_match('/^[a-zA-Z ]+$/', $prenom)) {
                    $input_prenom_class = 'is-invalid';
                    $input_prenom_message = 'Seuls les caractères alphabétiques sont autorisés';
                    $errors[] = $input_prenom_message;
                } else {
                    $input_prenom_class = 'is-valid';
                }
            }
        }


        if ($nom == '') {
            // Error
            $input_nom_class = 'is-invalid';
            $input_nom_message = 'Le champ nom est requis';
            $errors[] = $input_nom_message;
        } else {
            if (strlen($nom) < 3) {
                // Error
                $input_nom_class = 'is-invalid';
                $input_nom_message = 'Veuillez saisir plus de 3 caractères';
                $errors[] = $input_nom_message;
            } else {
                // Succcess
                if (!preg_match('/^[a-zA-Z ]+$/', $nom)) {
                    $input_nom_class = 'is-invalid';
                    $input_nom_message = 'Seuls les caractères alphabétiques sont autorisés';
                    $errors[] = $input_nom_message;
                } else {
                    $input_nom_class = 'is-valid';
                }
            }
        }

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
                if ($email_rows == 1) {
                    $input_email_class = 'is-invalid';
                    $input_email_message = "Cet email existe déja";
                    $errors[] = $input_email_message;
                } else {
                    $input_email_class = 'is-valid';
                }
            }
        }

        if ($password == '') {
            // Error
            $input_password_class = 'is-invalid';
            $input_password_message = 'Le champ mot de passe est requis';
            $errors[] = $input_password_message;
        } else {
            if (strlen($password) < 6) {
                // Error
                $input_password_class = 'is-invalid';
                $input_password_message = 'Veuillez saisir plus de 6 caractères';
                $errors[] = $input_password_message;
            } else {
                // Succcess
                if (!preg_match('/^[a-zA-Z0-9 ]+$/', $password)) {
                    $input_password_class = 'is-invalid';
                    $input_password_message = 'Erreur sur certains caractères spécifiques.';
                    $errors[] = $input_password_message;
                } else {
                    $input_password_class = 'is-valid';
                }
            }
        }

        if ($password_confirm == '' or $password != $password_confirm) {
            $input_password_confirm_class = 'is-invalid';
            $input_password_confirm_message = 'Les deux mot de passe ne sont pas identique';
            $errors[] = $input_password_confirm_message;
        } else {
            $input_password_confirm_class = 'is-valid';
        }

        // count($errors) == 0
        if (empty($errors)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $db->query("INSERT INTO users SET
                prenom = '$prenom',
                nom = '$nom',
                email = '$email',
                password = '$password_hash'
            ");
            $_SESSION['message'] =  "Bien ajouter";
            $_SESSION['color'] = "success";
            header('Location:login.php');
            exit;
        } // empty($errors)
    } else {
        $_SESSION['message'] =  "Veuillez remplire toutes les champs SVP !!!";
        $_SESSION['color'] = "danger";
        header('Location:register.php');
        exit;
    } // isset
} // BTN


?>

<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
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
                        CRÉER UN NOUVEAU COMPTE CLIENT
                    </h3>

                    <h5 class="text-center">
                        Informations personnelles
                    </h5>

                    <form method="post">

                        <div class="mb-3">

                            <label class="form-label" for="prenom">
                                Prénom:
                                (<span class="text-danger">*</span>)
                            </label>

                            <input name="prenom" type="text" class="form-control 
                            <?= $input_prenom_class ?? '' ?>" id=" prenom" placeholder="Veuillez saisir votre prénom SVP !" value="<?= $prenom ?? '' ?>">
                            <div class="invalid-feedback">
                                <?= $input_prenom_message ?? '' ?>
                            </div>

                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="nom">Nom:</label>

                            <input name="nom" type="text" class="form-control 
                            <?= $input_nom_class ?? '' ?>" id=" nom" placeholder="Veuillez saisir votre nom SVP !" value="<?= $nom ?? '' ?>">
                            <div class="invalid-feedback">
                                <?= $input_nom_message ?? '' ?>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Adresse mail:</label>

                            <input name="email" type="email" class="form-control 
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

                        <div class="form-group mb-3">
                            <label class="form-label" for="password_confirm">Confirmer le mot de passe:</label>

                            <input name="password_confirm" type="password" class="form-control 
                            <?= $input_password_confirm_class ?? '' ?>" id=" password_confirm" placeholder="Veuillez confirmer le mot de passe SVP !" value="<?= $password_confirm ?? '' ?>">
                            <div class="invalid-feedback">
                                <?= $input_password_confirm_message ?? '' ?>
                            </div>


                        </div>


                        <div class="mt-4">

                            <button type="submit" class="btn btn-dark" name="register_btn">
                                Créer un compte
                            </button>

                            <a href="login.html" class="btn btn-secondary">
                                Retour
                            </a>

                        </div>
                    </form>


                </div>
            </div>

        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>