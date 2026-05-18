<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['admin']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$users = $pdo->query('SELECT id, full_name, email, role, is_active, created_at FROM users ORDER BY id DESC')->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Manage Users</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>#<?= (int)$user['id'] ?></td>
                                        <td><?= e($user['full_name']) ?></td>
                                        <td><?= e($user['email']) ?></td>
                                        <td><span class="badge bg-secondary"><?= e($user['role']) ?></span></td>
                                        <td>
                                            <?php if ((int)$user['is_active'] === 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Blocked</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= e($user['created_at']) ?></td>
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
