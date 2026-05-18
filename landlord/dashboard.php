<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['landlord']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();

$countPropertiesStmt = $pdo->prepare('SELECT COUNT(*) AS total FROM properties WHERE landlord_id = :landlord_id');
$countPropertiesStmt->execute([':landlord_id' => (int)$_SESSION['user_id']]);
$totalProperties = (int)($countPropertiesStmt->fetch()['total'] ?? 0);

$countBookingsStmt = $pdo->prepare('SELECT COUNT(*) AS total FROM booking_requests WHERE landlord_id = :landlord_id');
$countBookingsStmt->execute([':landlord_id' => (int)$_SESSION['user_id']]);
$totalBookings = (int)($countBookingsStmt->fetch()['total'] ?? 0);
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Landlord Dashboard</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6>My Properties</h6>
                            <p class="mb-0 fs-4"><?= $totalProperties ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6>Booking Requests</h6>
                            <p class="mb-0 fs-4"><?= $totalBookings ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body d-flex flex-wrap gap-2">
                    <a class="btn btn-primary" href="<?= BASE_URL ?>/landlord/add-property.php">Add New Property</a>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/landlord/manage-properties.php">Manage Properties</a>
                    <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/landlord/bookings.php">View Bookings</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
