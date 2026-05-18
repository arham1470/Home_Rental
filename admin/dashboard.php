<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['admin']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();

$counts = [
    'users' => 0,
    'properties' => 0,
    'bookings' => 0,
    'inquiries' => 0
];

$counts['users'] = (int)($pdo->query('SELECT COUNT(*) FROM users')->fetchColumn() ?: 0);
$counts['properties'] = (int)($pdo->query('SELECT COUNT(*) FROM properties')->fetchColumn() ?: 0);
$counts['bookings'] = (int)($pdo->query('SELECT COUNT(*) FROM booking_requests')->fetchColumn() ?: 0);
$counts['inquiries'] = (int)($pdo->query('SELECT COUNT(*) FROM inquiries')->fetchColumn() ?: 0);
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Admin Dashboard</h2>
            <div class="row g-3">
                <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><h6>Users</h6><p class="fs-4 mb-0"><?= $counts['users'] ?></p></div></div></div>
                <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><h6>Properties</h6><p class="fs-4 mb-0"><?= $counts['properties'] ?></p></div></div></div>
                <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><h6>Bookings</h6><p class="fs-4 mb-0"><?= $counts['bookings'] ?></p></div></div></div>
                <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><h6>Inquiries</h6><p class="fs-4 mb-0"><?= $counts['inquiries'] ?></p></div></div></div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
