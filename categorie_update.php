<?php
require "database/database.php";
require "helpers/functions.php";

$id = $_GET['id'];
$p = $db->query("SELECT * FROM categories WHERE id = $id LIMIT 1")->fetch();

// echo "<pre>";
// print_r($p->name);
// echo "</pre>";
// exit;
if (isset($_POST['update_categorie'])) {

    $nom = $_POST['nom'];
    $icon = $_POST['icon'];

    $db->query("UPDATE categories SET nom = '$nom',icon = '$icon' WHERE id = $id");

    header("Location:categories.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Update categorie</title>
    <?php include "body/head.php"; ?>
    <?php include "body/scripts.php"; ?>

</head>

<body>
    <header>
        <!-- place navbar here -->

        <?php include "body/nav.php"; ?>
    </header>
    <main class="container mt-3">
        <h3>Modifier le categorie</h3>

        <div class="card shadow-sm">
            <div class="card-body">


                <form method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom:</label>
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom:" value="<?= $p->nom ?>" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon:</label>
                                <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon:" value="<?= $p->icon ?>" />
                            </div>
                        </div>
                        <!-- col -->

                    </div>
                    <!-- row -->

                    <button type="submit" name="update_categorie" class="btn btn-dark"> Modifier</button>
                </form>


            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>