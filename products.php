<?php
require "database/database.php";
require "helpers/functions.php";

// $req = $db->query("SELECT * FROM personnes")->fetchAll();

// echo '<pre>';
// print_r($req);
// echo '</pre>';
// exit;

$produits = $db->query("SELECT 
p.id, 
p.name,
p.image, 
p.quantity, 
p.price, 
c.nom AS categorie_name
    FROM products p
LEFT JOIN categories c ON c.id = p.categorie_id where p.deleted_at IS NULL")->fetchAll();

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
        <h3>Liste des produits</h3>

        <div class="card shadow-sm">
            <div class="card-body">

                <a href="product_add.php" class="btn btn-primary fw-bold mb-3">
                    Ajouter
                </a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Quantite</th>
                                <th>Prix</th>
                                <th>Categorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produits as $key => $p) : ?>

                                <tr>

                                    <td>
                                        <?= $p->id ?>
                                    </td>
                                    <td>
                                        <img src="images/<?= $p->image ?>" width="30" alt="...">

                                    </td>
                                    <td>
                                        <?= ucwords($p->name) ?>
                                    </td>

                                    <td>
                                        <?= $p->quantity ?>
                                    </td>

                                    <td>
                                        <?= number_format($p->price) ?>
                                    </td>
                                    <td>
                                        <?= ucwords($p->categorie_name) ?>
                                    </td>

                                    <td>
                                        <a href="product_show.php?id=<?= $p->id ?>" class="btn btn-dark fw-bold btn-sm">
                                            Afficher
                                        </a>

                                        <a href="product_update.php?id=<?= $p->id ?>" class="btn btn-dark fw-bold btn-sm">
                                            Modifier
                                        </a>

                                        <a href="product_delete.php?id=<?= $p->id ?>" class="btn btn-danger fw-bold btn-sm">
                                            Supprimar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach  ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

</html>