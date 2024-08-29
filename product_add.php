<?php
require "database/database.php";
require "helpers/functions.php";

if (isset($_POST['add_product'])) {

    // echo "<pre>";
    // print_r($_FILES["image"]['name']);
    // echo "</pre>";
    // exit;
    $image_name = $_FILES["image"]["name"];

    // $target_file = "images/" . basename($image_name);

    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // in_array($imageFileType, ['jpg', 'jpeg', 'png']);

    // // if($imageFileType == 'jpg' or $imageFileType == 'png' or $imageFileType == 'jpeg'){
    // if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
    //     move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    // }

    move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . basename($_FILES["image"]["name"]));

    // echo "<pre>";
    // print_r($imageFileType);
    // echo "</pre>";
    // exit;


    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $categorie_id = $_POST['categorie_id'];

    $db->query("INSERT INTO products SET name = '$name', quantity = '$quantity', price = '$price', old_price = '$old_price',categorie_id = $categorie_id, image = '$image_name'");

    header("Location:products.php");
    exit;
}


$categories = $db->query("SELECT id,nom FROM categories 
WHERE deleted_at IS NULL 
ORDER BY id DESC")->fetchAll();
// echo "<pre>";
// print_r($categories);
// echo "</pre>";
// exit;
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
        <h3>Ajouter un produit</h3>

        <div class="card shadow-sm">
            <div class="card-body">


                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name:" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity:" />
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col">
                            <div class="mb-3">
                                <label for="categorie_id" class="form-label">Categories:</label>

                                <select class="form-select" name="categorie_id" id="categorie_id">
                                    <option disabled>Choisir une categorie</option>
                                    <?php foreach ($categories as $key => $v) : ?>
                                        <option value="<?= $v->id ?>">
                                            <?= ucwords($v->nom) ?>
                                        </option>
                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Price:" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="old_price" class="form-label">Old price:</label>
                                <input type="text" class="form-control" name="old_price" id="old_price" placeholder="Old price:" />
                            </div>
                        </div>
                        <!-- col -->
                     
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" class="form-control" name="image" id="image" />
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->

                    <button type="submit" name="add_product" class="btn btn-primary">+ Ajouter</button>
                </form>


            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>