<?php if (!empty($_SESSION['flash'])): ?>
    <?php
    $flashType = $_SESSION['flash']['type'] ?? 'info';
    $flashMessage = $_SESSION['flash']['message'] ?? '';
    unset($_SESSION['flash']);
    ?>
    <div class="container mt-3">
        <div class="alert alert-<?= e($flashType) ?> alert-dismissible fade show" role="alert">
            <?= e($flashMessage) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
