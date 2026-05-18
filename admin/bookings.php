<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['admin']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->query('
    SELECT br.id, br.status, br.created_at, p.title AS property_title,
           tu.full_name AS tenant_name, lu.full_name AS landlord_name
    FROM booking_requests br
    INNER JOIN properties p ON p.id = br.property_id
    INNER JOIN users tu ON tu.id = br.tenant_id
    INNER JOIN users lu ON lu.id = br.landlord_id
    ORDER BY br.id DESC
');
$bookings = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Manage Bookings</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Property</th>
                                    <th>Tenant</th>
                                    <th>Landlord</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>#<?= (int)$booking['id'] ?></td>
                                        <td><?= e($booking['property_title']) ?></td>
                                        <td><?= e($booking['tenant_name']) ?></td>
                                        <td><?= e($booking['landlord_name']) ?></td>
                                        <td><span class="badge bg-secondary"><?= e($booking['status']) ?></span></td>
                                        <td><?= e($booking['created_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
