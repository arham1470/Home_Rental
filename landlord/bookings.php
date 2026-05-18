<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['landlord']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('
    SELECT br.id, br.status, br.message, br.move_in_date, br.created_at,
           p.title AS property_title, u.full_name AS tenant_name, u.email AS tenant_email
    FROM booking_requests br
    INNER JOIN properties p ON p.id = br.property_id
    INNER JOIN users u ON u.id = br.tenant_id
    WHERE br.landlord_id = :landlord_id
    ORDER BY br.id DESC
');
$stmt->execute([':landlord_id' => (int)$_SESSION['user_id']]);
$bookings = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Booking Requests</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (!$bookings): ?>
                        <p class="text-muted mb-0">No booking requests found.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th>Tenant</th>
                                        <th>Move-In</th>
                                        <th>Status</th>
                                        <th>Message</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $booking): ?>
                                        <tr>
                                            <td><?= e($booking['property_title']) ?></td>
                                            <td>
                                                <div><?= e($booking['tenant_name']) ?></div>
                                                <small class="text-muted"><?= e($booking['tenant_email']) ?></small>
                                            </td>
                                            <td><?= e((string)$booking['move_in_date']) ?></td>
                                            <td><span class="badge bg-secondary"><?= e($booking['status']) ?></span></td>
                                            <td><?= e($booking['message'] ?? '') ?></td>
                                            <td class="text-end">
                                                <form action="<?= BASE_URL ?>/actions/booking_action.php" method="post" class="d-inline">
                                                    <input type="hidden" name="action" value="update_status">
                                                    <input type="hidden" name="request_id" value="<?= (int)$booking['id'] ?>">
                                                    <input type="hidden" name="status" value="approved">
                                                    <button class="btn btn-sm btn-success">Approve</button>
                                                </form>
                                                <form action="<?= BASE_URL ?>/actions/booking_action.php" method="post" class="d-inline">
                                                    <input type="hidden" name="action" value="update_status">
                                                    <input type="hidden" name="request_id" value="<?= (int)$booking['id'] ?>">
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-sm btn-outline-danger">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
