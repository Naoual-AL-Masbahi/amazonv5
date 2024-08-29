<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Amazon</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products2.php">Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto d-flex">

                <?php if (isset($_SESSION['auth_amazonv5'])) : ?>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= ucwords($_SESSION['auth_amazonv5']->prenom) . " " . ucwords($_SESSION['auth_amazonv5']->nom)  ?>
                        </a>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>

                <?php else : ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                <?php endif ?>


            </ul>
        </div>
    </div>
</nav>