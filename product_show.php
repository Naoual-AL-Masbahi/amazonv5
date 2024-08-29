<?php
require "database/database.php";
require "helpers/functions.php";

$id = $_GET['id'];
$p = $db->query("SELECT 
p.id, 
p.name,
p.image, 
p.quantity, 
p.price, 
c.nom AS categorie_name
    FROM products p
LEFT JOIN categories c ON c.id = p.categorie_id WHERE p.id = $id LIMIT 1")->fetch();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Cart Page</title>
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
        <h2 class="my-3">Product Details</h2>

        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Id</dt>
                    <dd class="col-sm-9">
                        <?= $p->id ?>
                    </dd>

                    <dt class="col-sm-3">Image</dt>
                    <dd class="col-sm-9">
                        <img src="images/<?= $p->image ?>" width="60" class="img-fluid" alt="">
                    </dd>

                    <dt class="col-sm-3">Nom:</dt>
                    <dd class="col-sm-9">
                        <?= ucwords($p->name) ?>
                    </dd>

                    <dt class="col-sm-3">Quantité:</dt>
                    <dd class="col-sm-9">
                        <?= ucwords($p->quantity) ?>
                    </dd>

                    <dt class="col-sm-3">Categorie:</dt>
                    <dd class="col-sm-9">
                        <?= ucwords($p->categorie_name ) ?>
                    </dd>

                    <dt class="col-sm-3">Prix:</dt>
                    <dd class="col-sm-9">
                        <?= number_format($p->price, '2', ',', ' ') ?> DH
                    </dd>



                </dl>
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