<?php
require "database/database.php";
require "helpers/functions.php";


$categories = $db->query("SELECT * FROM categories 
WHERE deleted_at IS NOT NULL 
ORDER BY id DESC")->fetchAll();

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
        <h3>Liste des catégories qui sont archivée</h3>

        <div class="card shadow-sm">
            <div class="card-body">

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

                                        <a href="categorie_active.php?id=<?= $p->id ?>" class="btn btn-success fw-bold btn-sm">
                                            Activée
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