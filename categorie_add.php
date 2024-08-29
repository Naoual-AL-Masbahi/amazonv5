<?php
require "database/database.php";
require "helpers/functions.php";


if (isset($_POST['add_categorie'])) {

    $nom = $_POST['nom'];
    $icon = $_POST['icon'];

    $db->query("INSERT INTO categories SET nom = '$nom',icon = '$icon'");

    header("Location:categories.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <?php include "body/head.php"; ?>
    <?php include "body/scripts.php"; ?>

</head>

<body>
    <header>
        <!-- place navbar here -->

        <?php include "body/nav.php"; ?>
    </header>
    <main class="container mt-3">
        <h3>Ajouter une catégorie</h3>

        <div class="card shadow-sm">
            <div class="card-body">


                <form method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom:</label>
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom:" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col-md-3">
                            <div class="mb-3">


                                <div class="d-flex">
                                    <div class="me-auto">
                                        <label for="icon" class="form-label">Icon:</label>
                                    </div>
                                    <div>
                                        <a href="https://icons.getbootstrap.com/">All icons</a>
                                    </div>

                                </div>

                                <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon:" />
                            </div>
                        </div>
                        <!-- col -->

                    </div>
                    <!-- row -->

                    <button type="submit" name="add_categorie" class="btn btn-primary">+ Ajouter</button>
                </form>


            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>