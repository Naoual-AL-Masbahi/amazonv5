<?php if (isset($errors) and count($errors) > 0) : ?>
    <div class="alert alert-danger mt-3" role="alert">
        <h5>Liste des erreurs</h5>
        <ol>
            <?php foreach ($errors as $key => $error) : ?>
                <li> <?= $error ?> </li>
            <?php endforeach ?>
        </ol>
    </div>
<?php endif ?>