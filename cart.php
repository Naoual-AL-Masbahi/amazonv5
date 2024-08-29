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

        <h3>Cart page</h3>

        <div class="row">
            <div class="col-md-8">
                <h6>Articles</h6>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Img</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <img src="images/products/product_img1.jpg" width="30" alt="">
                            </td>
                            <td>
                                Blue Dress
                            </td>
                            <td>
                                200,00 DH
                            </td>
                            <td>
                                <div class="input-group mb-3 w-50">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon1">-</button>
                                    <input type="text" class="form-control text-center" placeholder="Quantity"
                                        value="2">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon2">+</button>
                                </div>
                            </td>
                            <td>
                                250,00 DH
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <img src="images/products/product_img2.jpg" width="30" alt="">
                            </td>
                            <td>
                                Red Shirt
                            </td>
                            <td>
                                300,00 DH
                            </td>
                            <td>
                                <div class="input-group mb-3 w-50">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon1">-</button>
                                    <input type="text" class="form-control text-center" placeholder="Quantity"
                                        value="2">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon2">+</button>
                                </div>
                            </td>
                            <td>
                                350,00 DH
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <img src="images/products/product_img3.jpg" width="30" alt="">
                            </td>
                            <td>
                                Black Dress
                            </td>
                            <td>
                                400,00 DH
                            </td>
                            <td>
                                <div class="input-group mb-3 w-50">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon1">-</button>
                                    <input type="text" class="form-control text-center" placeholder="Quantity"
                                        value="2">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon2">+</button>
                                </div>
                            </td>
                            <td>
                                450,00 DH
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <!-- col -->
            <div class="col-md-4">
                <h6>Summary Of Your Order</h6>


                <div class="bg-light p-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="COUPON CODE:">
                        <button class="btn btn-dark">APPLY</button>
                    </div>
                    <!-- input-group -->



                    <ul class="list-group">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent fw-bold">
                            Order Summary
                            <span class="badge bg-dark rounded-pill">
                                850,00 DH
                            </span>
                        </li>

                        <li
                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent fw-bold">
                            Discount
                            <span class="badge bg-dark rounded-pill">
                                200,00 DH
                            </span>
                        </li>

                        <li
                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent fw-bold">
                            Total To Pay
                            <span class="badge bg-dark rounded-pill">
                                650,00 DH
                            </span>
                        </li>

                    </ul>

                    <a href="proceed-checkout.php" class="btn btn-dark fw-bold mt-3 rounded-pill">
                        <i class="bi bi-credit-card-2-back"></i>
                        Proceed to checkout
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
    
</body>

</html>

