<?php if (isset($_SESSION['message'], $_SESSION['color'])) : ?>
    <div class="alert alert-<?= $_SESSION['color'] ?> mt-3" role="alert">
        <?= $_SESSION['message'] ?>
        <?php unset($_SESSION['message']) ?>
        <?php unset($_SESSION['color']) ?>
    </div>
<?php endif ?>