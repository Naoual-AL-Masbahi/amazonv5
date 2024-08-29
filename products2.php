<?php
require_once "database/database.php";
require_once "helpers/functions.php";

_check_if_user_connected();



if (isset($_POST['add_product'])) {
    $image_name = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . basename($_FILES["image"]["name"]));

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $categorie_id = $_POST['categorie_id'];
    $couleurs_id = $_POST['couleurs_id'];

    $db->query("INSERT INTO products SET  name = '$name', quantity = '$quantity', price = '$price', old_price = '$old_price',categorie_id = $categorie_id, couleurs_id = $couleurs_id, image = '$image_name'");

    header("Location:products2.php");
    exit;
}



if (isset($_POST['btn_update_product'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $categorie_id = $_POST['categorie_id'];
    $couleurs_id = $_POST['couleurs_id'];

    $db->query("UPDATE products SET  name = '$name', quantity = $quantity, price = $price, old_price = $old_price, categorie_id = $categorie_id, couleurs_id = $couleurs_id WHERE id = $id");

    header("Location:products2.php");
    exit;
}


if (isset($_POST['btn_delete_product'])) {
    $id = (int)$_POST['id'];
    $db->query("UPDATE products SET deleted_at = NOW() WHERE id = $id ");

    header('Location:products2.php');
    exit;
}

$req_not = '';

if (isset($_GET['status']) and $_GET['status'] == 'disable') {
    $req_not = 'NOT';
}

$products = $db->query("SELECT   
p.id, 
p.name,
p.image, 
p.quantity, 
p.price, 
p.old_price,
c.nom AS categorie_name,
cl.nom AS couleur_nom
    FROM products p
LEFT JOIN categories c ON c.id = p.categorie_id
LEFT JOIN couleurs cl ON cl.id = p.couleurs_id 
WHERE p.deleted_at IS  $req_not NULL 
ORDER BY p.id DESC")->fetchAll();

$categories = $db->query("SELECT id,nom FROM categories 
WHERE deleted_at IS NULL 
ORDER BY id DESC")->fetchAll();

$couleurs = $db->query("SELECT id,nom FROM couleurs 
WHERE deleted_at IS NULL 
ORDER BY id DESC")->fetchAll();

if (isset($_POST['btn_active_product'])) {
    $id = (int)$_POST['id'];
    // $db->query("DELETE FROM categories WHERE id = $id ");
    $db->query("UPDATE products SET deleted_at = NULL WHERE id = $id ");
    header('Location:products2.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Produits</title>
    <?php include_once "body/head.php" ?>
</head>

<body>
    <header>
        <?php include_once "body/nav.php" ?>

    </header>
    <main class="container mt-3">
        <h5 class="mb-3">Product Page</h5>
        <?php include_once "body/message_flash.php" ?>
        <?php include_once "body/message_error.php" ?>

        <div class="card">
            <div class="card-header">
                <h6>Liste des produits</h6>
            </div>

            <div class="card-body">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark btn-sm mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modal_product_add">
                    Ajouter
                </button>

                <!-- Modal  Add-->
                <div class="modal fade" id="modal_product_add" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">
                                    Ajouter un produit
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

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
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="couleurs_id" class="form-label">Couleurs:</label>

                                                <select class="form-select" name="couleurs_id" id="couleurs_id">
                                                    <option disabled>Choisir un couleur</option>
                                                    <?php foreach ($couleurs as $key => $v) : ?>
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" name="add_product" class="btn btn-primary">+ Ajouter</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- div end modal Add-->

                <?php if (empty($req_not)) : ?>
                    <!-- Button trigger modal -->
                    <a href="products2.php?status=disable" class="btn btn-secondary btn-sm mb-3 fw-bold">
                        Archives
                    </a>
                <?php else :  ?>
                    <a href="products2.php?" class="btn btn-success btn-sm mb-3 fw-bold">
                        Retour
                    </a>


                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Quantite</th>
                                <th>Prix</th>
                                <th>Categorie</th>
                                <th>Couleurs</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($products as $key => $p) : ?>
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
                                    <?= ucwords($p->couleur_nom) ?>
                                </td>
                                <td>

                                    <!-- Button modal show -->
                                    <button type="button" class="btn btn-secondary btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modal_show_product_<?= $p->id ?>">
                                        Afficher
                                    </button>

                                    <!-- Start Modal Show -->
                                    <div class="modal fade" id="modal_show_product_<?= $p->id ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">
                                                        Afficher
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">


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


                                                        <dt class="col-sm-3">Prix:</dt>
                                                        <dd class="col-sm-9">
                                                            <?= number_format($p->price, '2', ',', ' ') ?> DH
                                                        </dd>

                                                        <dt class="col-sm-3">Olde_Prix:</dt>
                                                        <dd class="col-sm-9">
                                                            <?= number_format($p->old_price, '2', ',', ' ') ?> DH
                                                        </dd>

                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end modal show  -->



                                    <!-- Button modal update -->
                                    <button type="button" class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modal_update_product_<?= $p->id ?>">
                                        Modifier
                                    </button>

                                    <!-- Start Modal update-->
                                    <div class="modal fade" id="modal_update_product_<?= $p->id ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-6">
                                                        Modifier <?= $p->name; ?>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

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
                                                                <div class="mb-3">
                                                                    <label for="couleurs_id" class="form-label">Couleurs:</label>

                                                                    <select class="form-select" name="couleurs_id" id="couleurs_id">
                                                                        <option disabled>Choisir un couleur</option>
                                                                        <?php foreach ($couleurs as $key => $v) : ?>
                                                                            <option <?= $p->couleurs_id == $v->id  ? 'selected' : '' ?> value="<?= $v->id ?>">
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


                                                        <div align="right" class="mt-3">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                                            <input name="id" type="hidden" value="<?= $p->id ?>">


                                                            <button type="submit" name="btn_update_product" class="btn btn-sm btn-dark">
                                                                Modifier
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end update modal -->



                                    <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modal_delete_product_<?= $p->id ?>">
                                        Supprimer
                                    </button>

                                    <!-- start delete Modal -->
                                    <div class="modal fade" id="modal_delete_product_<?= $p->id ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-6 text-danger">
                                                        Voulez vous vraiment supprimer <?= $p->name ?> ?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
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


                                                            <dt class="col-sm-3">Prix:</dt>
                                                            <dd class="col-sm-9">
                                                                <?= number_format($p->price, '2', ',', ' ') ?> DH
                                                            </dd>

                                                            <dt class="col-sm-3">Categorie:</dt>
                                                            <dd class="col-sm-9">
                                                                <?= ucwords($p->categorie_name) ?>
                                                            </dd>
                                                            <dt class="col-sm-3">Couleur:</dt>
                                                            <dd class="col-sm-9">
                                                                <?= ucwords($p->couleur_nom) ?>
                                                            </dd>

                                                        </dl>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <form method="post">
                                                            <button type="button" class="btn btn-secondary fw-bold btn-sm" data-bs-dismiss="modal">Fermer</button>

                                                            <input name="id" type="hidden" value="<?= $p->id ?>">

                                                            <button name="btn_delete_product" type="submit" class="btn btn-danger fw-bold btn-sm">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Modal delete -->
                                    <button type="button" class="btn btn-success btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modal_active_product_<?= $p->id ?>">
                                        Activer
                                    </button>

                                    <!-- start active Modal -->
                                    <div class="modal fade" id="modal_active_product_<?= $p->id ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-6 text-success">
                                                        Voulez vous vraiment activer <?= $p->name ?> ?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
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


                                                            <dt class="col-sm-3">Prix:</dt>
                                                            <dd class="col-sm-9">
                                                                <?= number_format($p->price, '2', ',', ' ') ?> DH
                                                            </dd>

                                                            <dt class="col-sm-3">Categorie:</dt>
                                                            <dd class="col-sm-9">
                                                                <?= ucwords($p->categorie_name) ?>
                                                            </dd>
                                                            <dt class="col-sm-3">Couleur:</dt>
                                                            <dd class="col-sm-9">
                                                                <?= ucwords($p->couleur_nom) ?>
                                                            </dd>

                                                        </dl>
                                                    </div>
                                                    <div class="modal-footer">

                                                        
                                                            <button type="button" class="btn btn-secondary fw-bold btn-sm" data-bs-dismiss="modal">Fermer</button>

                                                            <input name="id" type="hidden" value="<?= $p->id ?>">

                                                            <button name="btn_active_product" type="submit" class="btn btn-success fw-bold btn-sm">activer</button>
                                
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Modal active -->

                                </td>
                            </tr>
<?php endforeach?>
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
    <?php include_once "body/scripts.php" ?>
</body>

</html>