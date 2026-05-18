<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['tenant']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('
    SELECT id, subject, status, created_at
    FROM inquiries
    WHERE sender_id = :sender_id
    ORDER BY id DESC
');
$stmt->execute([':sender_id' => (int)$_SESSION['user_id']]);
$inquiries = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">My Inquiries</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (!$inquiries): ?>
                        <p class="text-muted mb-0">No inquiries yet.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inquiries as $inquiry): ?>
                                        <tr>
                                            <td>#<?= (int)$inquiry['id'] ?></td>
                                            <td><?= e($inquiry['subject']) ?></td>
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
