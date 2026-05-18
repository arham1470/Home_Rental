<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['tenant']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Tenant Dashboard</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm"><div class="card-body"><h6>Saved Properties</h6><p class="mb-0 fs-4">0</p></div></div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm"><div class="card-body"><h6>My Requests</h6><p class="mb-0 fs-4">0</p></div></div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm"><div class="card-body"><h6>Inquiries</h6><p class="mb-0 fs-4">0</p></div></div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <p class="mb-0 text-muted">Welcome, <?= e($_SESSION['full_name'] ?? 'Tenant') ?>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
