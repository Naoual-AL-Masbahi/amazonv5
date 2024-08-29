<?php
require "database/database.php";
require "helpers/functions.php";

// $price = 25799.99;

// echo number_format($price, '2', ',', ' ');


// exit;
// require "database/db.php";
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

// $id = $_GET['id'];

// echo $id;

// echo '<pre>';
// print_r($produits[$id]);
// echo '</pre>';

// $p = $produits[$id];



if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Error id";
    $_SESSION['color'] = "danger";

    header('Location:shop.php');
    exit;
}
$id = $_GET['id'];
$p = $db->query("SELECT * FROM products WHERE id = $id LIMIT 1")->fetch();


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

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
                <li class="breadcrumb-item active">Product Details</li>
            </ol>
        </nav>


        <?php include_once "body/message_flash.php" ?>

        <div class="row">
            <div class="col-md-6">
                <img src="images/<?= $p->image ?>" class="img-fluid" alt="">
            </div>
            <!-- col -->
            <div class="col-md-6">
                <h4>
                    <?= ucwords($p->name) ?>
                </h4>

                <div class="text-warning">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>

                <p class="my-2">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias dolor accusantium totam repellendus,
                    distinctio maiores minus rem excepturi ipsum deserunt, porro saepe ad non quaerat consequuntur.
                </p>


                <form class="mt-3">
                    <div class="row">
                        <div class="col">
                            <label for="size">Size</label>
                            <select class="form-select" id="size">
                                <option selected>Select your size</option>
                                <option value="1">S</option>
                                <option value="2">M</option>
                                <option value="3">L</option>
                                <option value="4">XL</option>
                            </select>
                        </div>
                        <!-- col -->

                        <div class="col">
                            <label for="color">Color</label>
                            <select class="form-select" id="color">
                                <option selected>Select your color</option>
                                <option value="1">Black</option>
                                <option value="2">Blue</option>
                                <option value="3">Red</option>
                                <option value="4">Yellow</option>
                            </select>
                        </div>
                        <!-- col -->

                    </div>
                    <!-- row -->



                    <h4 class="my-3 fw-bold">




                        <?= number_format($p->price, '2', ',', ' ') ?> DH



                        <del class="text-danger">
                            <?= number_format($p->old_price, '2', ',', ' ') ?> DH
                        </del>
                    </h4>

                    <a href="cart.html" class="btn btn-dark fw-bold">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Add To Cart
                    </a>

                </form>




            </div>
            <!-- col -->

        </div>
        <!-- row -->

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