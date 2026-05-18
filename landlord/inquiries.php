<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['landlord']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('
    SELECT i.id, i.subject, i.message, i.status, i.created_at, u.full_name AS sender_name, u.email AS sender_email
    FROM inquiries i
    INNER JOIN users u ON u.id = i.sender_id
    WHERE i.receiver_id = :receiver_id OR i.receiver_id IS NULL
    ORDER BY i.id DESC
');
$stmt->execute([':receiver_id' => (int)$_SESSION['user_id']]);
$inquiries = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Tenant Inquiries</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (!$inquiries): ?>
                        <p class="text-muted mb-0">No inquiries found.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inquiries as $inquiry): ?>
                                        <tr>
                                            <td>
                                                <div><?= e($inquiry['sender_name']) ?></div>
                                                <small class="text-muted"><?= e($inquiry['sender_email']) ?></small>
                                            </td>
                                            <td><?= e($inquiry['subject']) ?></td>
                                            <td><?= e($inquiry['message']) ?></td>
                                            <td><span class="badge bg-info text-dark"><?= e($inquiry['status']) ?></span></td>
                                            <td><?= e($inquiry['created_at']) ?></td>
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
