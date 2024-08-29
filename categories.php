<?php
require "database/database.php";
require "helpers/functions.php";


// $req = $db->query("SELECT * FROM personnes")->fetchAll();

// echo '<pre>';
// print_r($req);
// echo '</pre>';
// exit;

$categories = $db->query("SELECT * FROM categories 
WHERE deleted_at IS NULL 
ORDER BY id DESC")->fetchAll();

// $total_archive = $db->query("SELECT COUNT(id) AS total_archive FROM categories WHERE deleted_at IS NOT NULL LIMIT 1")->fetch()->total_archive;

$total_archive = $db->query("SELECT id FROM categories WHERE deleted_at IS NOT NULL ")->rowCount();


// echo "<pre>";
// print_r($total_archive);
// echo "</pre>";
// exit;

?>

<!doctype html>
<html lang="en">

<head>
    <?php include "body/head.php"; ?>
</head>

<body>
    <header>
        <?php include "body/nav.php"; ?>
    </header>
    <main class="container mt-3">
        <h3>Liste des catégories</h3>

        <div class="card shadow-sm">
            <div class="card-body">

                <a href="categorie_add.php" class="btn btn-primary btn-sm fw-bold mb-3">
                    Ajouter
                </a>

                <a href="categories_archive.php" class="btn btn-secondary btn-sm fw-bold mb-3">
                    Archives
                    <?php if ($total_archive > 0) : ?>
                        <span class="badge text-bg-light">
                            <?= $total_archive; ?>
                        </span>
                    <?php endif ?>
                </a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Icon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $key => $p) : ?>

                                <tr>

                                    <td>
                                        <?= $p->id ?>
                                    </td>

                                    <td>
                                        <?= ucwords($p->nom) ?>
                                    </td>


                                    <td>
                                        <i class="bi bi-<?= $p->icon ?>"></i>

                                    </td>

                                    <td>
                                        <a href="categorie_show.php?id=<?= $p->id ?>" class="btn btn-dark fw-bold btn-sm">
                                            Afficher
                                        </a>

                                        <a href="categorie_update.php?id=<?= $p->id ?>" class="btn btn-dark fw-bold btn-sm">
                                            Modifier
                                        </a>

                                        <a href="categorie_delete.php?id=<?= $p->id ?>" class="btn btn-danger fw-bold btn-sm">
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
    <!-- Bootstrap JavaScript Libraries -->
    <?php include "body/scripts.php"; ?>

</body>

</html>