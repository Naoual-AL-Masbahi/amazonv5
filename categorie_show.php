<?php

require "database/database.php";
require "helpers/functions.php";


$id = $_GET['id'];

$p = $db->query("SELECT * FROM categories WHERE id = $id LIMIT 1")->fetch();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Categorie detailss Page</title>
    <?php include "body/head.php"; ?>
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


                    <dt class="col-sm-3">Icon:</dt>
                    <dd class="col-sm-9">
                        <i class="bi bi-<?= $p->icon ?>"></i>
                    </dd>



                </dl>

            </div>
        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <?php include "body/scripts.php"; ?>
</body>

</html>