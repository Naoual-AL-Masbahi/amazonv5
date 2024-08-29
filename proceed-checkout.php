<?php
require "database/database.php";
require "helpers/functions.php";

?>
<!doctype html>
<html lang="en">

<head>
    <title>Cart</title>
    <?php include "body/head.php"; ?>
    <?php include "body/scripts.php"; ?>

</head>

<body>
    <header>
        <!-- place navbar here -->

        <?php include "body/nav.php"; ?>

    </header>
    <main class="container mt-3">

<h3>Proceed checkout</h3>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
        <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
        <li class="breadcrumb-item active" aria-current="page">Proceed checkout</li>
    </ol>
</nav>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Name:</label>
                                <input type="text" class="form-control" name="" id=""
                                    placeholder="Ex: John Doe" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Phone:</label>
                                <input type="tel" class="form-control" name="" id=""
                                    placeholder="Ex: +212 680 654 338" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">City:</label>
                                <input type="text" class="form-control" name="" id=""
                                    placeholder="Ex: Tanger" />
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->
                </form>
            </div>
            <!-- card-body -->
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-4">
        <div class="bg-light p-3">
            <h3>Total: 750,00 DH</h3>

            <ul class="list-group">
                <li class="list-group-item bg-transparent">

                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="images/products/product_img1.jpg" width="60" alt="...">
                        </div>
                        <!-- flex-shrink-0 -->
                        <div class="flex-grow-1 ms-3">
                            <h5>Blue Dress</h5>
                            <h6>300,00 DH <span class="text-success">2 quantity</span></h6>
                        </div>
                        <!-- flex-grow-1 -->
                    </div>
                    <!-- d-flex -->
                </li>


                <li class="list-group-item bg-transparent">

                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="images/products/product_img2.jpg" width="60" alt="...">
                        </div>
                        <!-- flex-shrink-0 -->
                        <div class="flex-grow-1 ms-3">
                            <h5>Red Shirt</h5>
                            <h6>450,00 DH <span class="text-success">2 quantity</span></h6>
                        </div>
                        <!-- flex-grow-1 -->
                    </div>
                    <!-- d-flex -->
                </li>

            </ul>


            <a href="tank-you.html" class="btn btn-dark fw-bold rounded-pill mt-2">
                Confirm Order
            </a>
        </div>
        <!-- bg-light -->
    </div>
    <!-- col -->

</div>
<!-- row -->


</main>
<footer>
<!-- place footer here -->
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>

</html>