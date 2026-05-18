<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['tenant']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('
    SELECT br.id, br.status, br.move_in_date, br.created_at, p.title, p.location
    FROM booking_requests br
    INNER JOIN properties p ON p.id = br.property_id
    WHERE br.tenant_id = :tenant_id
    ORDER BY br.id DESC
');
$stmt->execute([':tenant_id' => (int)$_SESSION['user_id']]);
$requests = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">My Rental Requests</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (!$requests): ?>
                        <p class="text-muted mb-0">No rental requests found.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th>Location</th>
                                        <th>Move-in</th>
                                        <th>Status</th>
                                        <th>Requested On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td><?= e($request['title']) ?></td>
                                            <td><?= e($request['location']) ?></td>
                                            <td><?= e((string)$request['move_in_date']) ?></td>
                                            <td><span class="badge bg-secondary"><?= e($request['status']) ?></span></td>
                                            <td><?= e($request['created_at']) ?></td>
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
