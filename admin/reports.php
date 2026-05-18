<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['admin']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();

$summary = [
    'active_users' => (int)($pdo->query('SELECT COUNT(*) FROM users WHERE is_active = 1')->fetchColumn() ?: 0),
    'available_properties' => (int)($pdo->query("SELECT COUNT(*) FROM properties WHERE status = 'available'")->fetchColumn() ?: 0),
    'approved_bookings' => (int)($pdo->query("SELECT COUNT(*) FROM booking_requests WHERE status = 'approved'")->fetchColumn() ?: 0),
    'open_inquiries' => (int)($pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'open'")->fetchColumn() ?: 0),
];
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">System Reports</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Active Users</span>
                            <strong><?= $summary['active_users'] ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Available Properties</span>
                            <strong><?= $summary['available_properties'] ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Approved Bookings</span>
                            <strong><?= $summary['approved_bookings'] ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Open Inquiries</span>
                            <strong><?= $summary['open_inquiries'] ?></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
