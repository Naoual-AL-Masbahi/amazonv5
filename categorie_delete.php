<?php

require "database/database.php";
require "helpers/functions.php";

$id = $_GET['id'];

$p = $db->query("SELECT * FROM categories WHERE id = $id LIMIT 1")->fetch();

if (isset($_POST['categorie_delete'])) {
    // $db->query("DELETE FROM categories WHERE id = $id ");
    $db->query("UPDATE categories SET deleted_at = NOW() WHERE id = $id ");
    header('Location:categories.php');
    exit;
}



?>
<!doctype html>
<html lang="en">

<head>
    <title>Categorie delete Page</title>
    <!-- Required meta tags -->
    <?php include "body/head.php"; ?>
    <?php include "body/scripts.php"; ?>

</head>

<body>
    <header>
        <!-- place navbar here -->

        <?php include "body/nav.php"; ?>


    </header>
    <main class="container">
        <h2 class="my-3">Categorie Details</h2>

        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Id</dt>
                    <dd class="col-sm-9">
                        <?= $p->id ?>
                    </dd>



                    <dt class="col-sm-3">Nom:</dt>
                    <dd class="col-sm-9">
                        <?= ucwords($p->nom) ?>
                    </dd>

                </dl>



                <h5 class="text-danger">
                    Voulez vous vraiment supprimer <?= ucwords($p->nom) ?> ?
                </h5>

                <form method="post">
                    <a href="products.php" class="btn btn-secondary">Nom</a>
                    <button type="submit" name="categorie_delete" class="btn btn-danger">Oui</button>
                </form>
            </div>
        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>