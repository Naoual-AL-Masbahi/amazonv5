<?php
require "database/database.php";
require "helpers/functions.php";

 $products = $db->query("SELECT * FROM products")->fetchAll();

$categories = $db->query("SELECT * FROM categories")->fetchAll();

$couleurs = $db->query("SELECT * FROM couleurs")->fetchAll();


// CRUDS
// C = CREATE
// R = READ
// U = UPDATE
// D = DELETE
// S = SEARCH




?>
<!doctype html>
<html lang="en">

<head>
    <title>Shop page</title>
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
        <?php include_once "body/message_flash.php" ?>

        <h3 class="mt-3">Shop</h3>



        <div class="row">
            <div class="col-md-3">

                <h5>Catégories</h5>
                <a href="shop.php" style="text-decoration: none;">
                <ul class="list-group list-group-flush mb-3">
                     
                    <?php foreach ($categories as $key => $value) : ?>
                        <li class="list-group-item">
                            <i class="bi bi-<?= $value->icon ?>"></i>
                            <?= $value->nom ?>
                        </li>
                    <?php endforeach ?>
                </ul>
                </a>

                <h5>Couleurs</h5>

                <ul class="list-group list-group-flush">
                <?php foreach ($couleurs as $key => $value) : ?>
                        <li class="list-group-item">
                            <i class="bi bi-circle-fill" style="color:<?= $value->nom ?>"></i>
                            <?= $value->nom ?>
                        </li>
                    <?php endforeach ?>
                            
                </ul>
            </div>
            <!-- col 1 -->

            <div class="col-md-9">
                <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1 gy-2">
                    <?php foreach ($products as $key => $value) : ?>
                        <div class="col">
                            <div class="card">
                                <a href="product-details.php?id=<?= $value->id ?>">
                                    <img src="images/<?= $value->image ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= $value->name ?>
                                    </h5>
                                    <h5>
                                        <?= number_format($value->price) ?> DH

                                        <s class="text-danger">
                                            <?= number_format($value->old_price) ?> DH
                                        </s>
                                    </h5>
                                    <a href="cart.php" class="btn btn-dark fw-bold">
                                        <i class="bi bi-cart-fill"></i>
                                        Add to cart
                                    </a>
                                </div>
                                <!-- card-body -->
                            </div>
                            <!-- card -->
                        </div>
                        <!-- col -->
                    <?php endforeach ?>

                </div>
                <!-- row -->
            </div>
            <!-- col 1 -->
        </div>
        <!-- row 1 -->










    </main>
    <footer>
        <!-- place footer here -->

</body>

</html>