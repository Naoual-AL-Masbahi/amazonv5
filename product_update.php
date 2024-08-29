<?php
require "database/database.php";
require "helpers/functions.php";

$id = $_GET['id'];
$p = $db->query("SELECT 
id, 
name,
image, 
quantity, 
price, 
old_price, 
categorie_id
    FROM products
 WHERE id = $id LIMIT 1")->fetch();


// echo "<pre>";
// print_r($p->name);
// echo "</pre>";
// exit;
if (isset($_POST['update_product'])) {

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $categorie_id = $_POST['categorie_id'];

    $db->query("UPDATE products SET name = '$name', quantity = $quantity, price = $price, categorie_id = $categorie_id, old_price = $old_price WHERE id = $id");

    header("Location:products.php");
    exit;
}


$categories = $db->query("SELECT id,nom FROM categories 
WHERE deleted_at IS NULL 
ORDER BY id DESC")->fetchAll();

?>


<!doctype html>
<html lang="en">

<head>
    <title>Update product</title>
    <?php include "body/head.php"; ?>
    <?php include "body/scripts.php"; ?>

</head>

<body>
    <header>
        <!-- place navbar here -->

        <?php include "body/nav.php"; ?>
    </header>
    <main class="container mt-3">
        <h3>Modifier le produit</h3>

        <div class="card shadow-sm">
            <div class="card-body">


                <form method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" class="form-control" name="image" id="image" />
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name:" value="<?= $p->name ?>" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity:" value="<?= $p->quantity ?>" />
                            </div>
                        </div>
                        <!-- col -->

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Price:" value="<?= $p->price ?>" />
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col">
                            <div class="mb-3">
                                <label for="categorie_id" class="form-label">Categories:</label>

                                <select class="form-select" name="categorie_id" id="categorie_id">
                                    <option disabled>Choisir une categorie</option>
                                    <?php foreach ($categories as $key => $v) : ?>
                                        <option <?= $p->categorie_id == $v->id  ? 'selected' : '' ?> value="<?= $v->id ?>">
                                            <?= ucwords($v->nom) ?>
                                        </option>
                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="old_price" class="form-label">Old price:</label>
                                <input type="text" class="form-control" name="old_price" id="old_price" placeholder="Old price:" value="<?= $p->old_price ?>" />
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->

                    <button type="submit" name="update_product" class="btn btn-dark"> Modifier</button>
                </form>


            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>