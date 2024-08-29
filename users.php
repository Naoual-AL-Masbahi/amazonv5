<?php

require "database/database.php";
require "helpers/functions.php";

$page = "users";

  _check_if_user_connected();

$status = "enable";
if (isset($_GET['status'])) {
    $status = e($_GET['status']);
}

if (isset($_POST['btn_add_user'])) {
    $nom = e($_POST['nom']);
    $email = e($_POST['email']);
    $password = e($_POST['password']);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $db->query("INSERT INTO users SET 
        nom = '$nom',
        email = '$email',
        password = '$password_hash',
        deleted_at = NOW()
    ");

    $_SESSION['message'] = "Bien ajouter";
    $_SESSION['couleur'] = "success";
    header("Location:users.php");
    exit;
}




if (isset($_POST['btn_update_user'])) {
    $id = (int)$_POST['id'];
    $nom = e($_POST['nom']);
    $email = e($_POST['email']);
    $password = e($_POST['password']);

    $req_password = "";

    if (!empty($password)) {
        $password = e($_POST['password']);
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $req_password = " ,password = '$password_hash' ";
    }

    // $query = "UPDATE users SET 
    // nom = '$nom',
    // email = '$email'
    // $req_password
    // WHERE id = $id";

    // dd($query);

    $db->query("UPDATE users SET 
        nom = '$nom',
        email = '$email'
        $req_password
        WHERE id = $id
    ");


    $_SESSION['message'] = "Bien modifier";
    $_SESSION['couleur'] = "success";
    header("Location:users.php");
    exit;
}




if (isset($_POST['btn_disable_user'])) {

    $id = (int)$_POST['id'];
    $db->query("UPDATE users SET deleted_at = NOW() WHERE id = $id");
    $_SESSION['message'] = "Bien désactiver";
    $_SESSION['couleur'] = "success";
    header("Location:users.php");
    exit;
}


if (isset($_POST['btn_enable_user'])) {

    $id = (int)$_POST['id'];
    $db->query("UPDATE users SET deleted_at = NULL WHERE id = $id");
    $_SESSION['message'] = "Bien activer";
    $_SESSION['couleur'] = "success";
    header("Location:users.php");
    exit;
}


// if ($status == "enable") {
//     $users = $db->query("SELECT * FROM users WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();
// } else {
//     $users = $db->query("SELECT * FROM users WHERE deleted_at IS NOT NULL ORDER BY id DESC")->fetchAll();
// }

$req_not = $status == "enable" ? "" : " NOT ";

$users = $db->query("SELECT * FROM users WHERE deleted_at IS $req_not NULL ORDER BY id DESC")->fetchAll();

// echo "<pre>";
// print_r($produits);
// echo "</pre>";
// exit;
?>

<!doctype html>
<html lang="en">

<head>
    <title>Liste des utilisateurs</title>
    <!-- Required meta tags -->

    <?php include_once "body/head.php"; ?>
    <?php include_once "body/script.php"; ?>
</head>

<body>
    <header>
        <!-- place navbar here -->
        <?php include_once "body/nav.php"; ?>
    </header>
    <main class="container mt-3">

        <?php include_once "body/messaged_errors.php"; ?>

        <?php include_once "body/message_flash.php"; ?>

        <h3>Liste des utilisateurs</h3>



        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>

        <?php include_once("body/message_flash.php") ?>

        <div class="card">
            <div class="card-header">
                <h6>Liste des categories</h6>
            </div>
            <div class="card-body">


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal_add_user">
                    Ajouter
                </button>

                <div class="modal fade" id="modal_add_user" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="post">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">
                                        Ajouter
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- modal-header -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom:</label>
                                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom:" />
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email:</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email:" />
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mot de passe:</label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe:" />
                                            </div>
                                        </div>
                                        <!-- col -->
                                    </div>
                                    <!-- row -->
                                </div>
                                <!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" name="btn_add_user" class="btn btn-primary">
                                        Ajouter
                                    </button>
                                </div>
                                <!-- modal-footer -->
                            </form>
                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>

                <?php if ($status == "enable") :  ?>
                    <a href="users.php?status=disable" class="btn btn-secondary mb-3">
                        Archive
                    </a>
                <?php else :  ?>
                    <a href="users.php" class="btn btn-success mb-3">
                        Active
                    </a>
                <?php endif  ?>


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-light">
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $u) : ?>

                                <?php
                                if ($u['deleted_at']) {
                                    $badge_class = "danger";
                                    $badge_name = "Desactiver";
                                } else {
                                    $badge_class = "success";
                                    $badge_name = "Activer";
                                }
                                ?>
                                <tr>

                                    <td><?= $u['id'] ?></td>
                                    <td><?= ucwords($u['nom']) ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-<?= $badge_class  ?>">
                                            <?= $badge_name ?>
                                        </span>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_show_user_<?= $u['id'] ?>">
                                            Afficher
                                        </button>

                                        <div class="modal fade" id="modal_show_user_<?= $u['id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">
                                                            Afficher
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <div class="modal-body">
                                                        <ul>
                                                            <li>Id: <?= $u['id'] ?></li>
                                                            <li>Nom: <?= ucwords($u['nom']) ?></li>
                                                            <li>Email: <?= $u['email'] ?></li>
                                                            <li>
                                                                Status:

                                                                <span class="badge rounded-pill text-bg-<?= $badge_class  ?>">
                                                                    <?= $badge_name ?>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- modal-body -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                    <!-- modal-footer -->
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- Modal -->


                                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modal_update_user_<?= $u['id'] ?>">
                                            Modifier
                                        </button>

                                        <div class="modal fade" id="modal_update_user_<?= $u['id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <form method="post">

                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">
                                                                Modifier
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- modal-header -->
                                                        <div class="modal-body">


                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="nom" class="form-label">Nom:</label>
                                                                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom:" value="<?= $u['nom'] ?>" />
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email:</label>
                                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email:" value="<?= $u['email'] ?>" />
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="password" class="form-label">Nouveau Mot de passe:</label>
                                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe:" />
                                                                    </div>
                                                                </div>
                                                                <!-- col -->
                                                            </div>
                                                            <!-- row -->



                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">

                                                            <button type="submit" name="btn_update_user" class="btn btn-dark">
                                                                Modifier
                                                            </button>
                                                        </div>
                                                        <!-- modal-footer -->
                                                    </form>

                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- Modal -->





                                        <?php if (!$u['deleted_at']) : ?>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_disable_user_<?= $u['id'] ?>">
                                                Désactivé
                                            </button>

                                            <div class="modal fade" id="modal_disable_user_<?= $u['id'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">
                                                                Désactiver
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- modal-header -->
                                                        <div class="modal-body">
                                                            <ul>
                                                                <li>Id: <?= $u['id'] ?></li>
                                                                <li>Nom: <?= ucwords($u['nom']) ?></li>
                                                                <li>Email: <?= $u['email'] ?></li>
                                                                <li>
                                                                    Status:

                                                                    <span class="badge rounded-pill text-bg-<?= $u['deleted_at'] ? 'danger' : 'success' ?>">
                                                                        <?= $u['deleted_at'] ? 'Desactiver' : 'Activer' ?>
                                                                    </span>
                                                                </li>
                                                            </ul>

                                                            <h6 class="text-danger">
                                                                Voulez vous vraiment désactiver <?= ucwords($u['nom']) ?> ?
                                                            </h6>
                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <form method="post">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                                <input type="hidden" name="id" value="<?= $u['id'] ?>">

                                                                <button type="submit" name="btn_disable_user" class="btn btn-danger">
                                                                    Oui
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <!-- modal-footer -->
                                                    </div>
                                                    <!-- modal-content -->
                                                </div>
                                                <!-- modal-dialog -->
                                            </div>
                                            <!-- Modal -->

                                        <?php else : ?>

                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_enable_user_<?= $u['id'] ?>">
                                                Activé
                                            </button>

                                            <div class="modal fade" id="modal_enable_user_<?= $u['id'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">
                                                                Activer
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- modal-header -->
                                                        <div class="modal-body">
                                                            <ul>
                                                                <li>Id: <?= $u['id'] ?></li>
                                                                <li>Nom: <?= ucwords($u['nom']) ?></li>
                                                                <li>Email: <?= $u['email'] ?></li>
                                                                <li>
                                                                    Status:

                                                                    <span class="badge rounded-pill text-bg-<?= $u['deleted_at'] ? 'danger' : 'success' ?>">
                                                                        <?= $u['deleted_at'] ? 'Desactiver' : 'Activer' ?>
                                                                    </span>
                                                                </li>
                                                            </ul>

                                                            <h6 class="text-success">
                                                                Voulez vous vraiment activer <?= ucwords($u['nom']) ?> ?
                                                            </h6>
                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <form method="post">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                                <input type="hidden" name="id" value="<?= $u['id'] ?>">

                                                                <button type="submit" name="btn_enable_user" class="btn btn-success">
                                                                    Oui
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <!-- modal-footer -->
                                                    </div>
                                                    <!-- modal-content -->
                                                </div>
                                                <!-- modal-dialog -->
                                            </div>
                                            <!-- Modal -->


                                        <?php endif ?>












                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</body>

</html>