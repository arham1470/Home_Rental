<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['tenant']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('SELECT full_name, email, phone, address FROM users WHERE id = :id LIMIT 1');
$stmt->execute([':id' => (int)$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">My Profile</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="<?= BASE_URL ?>/actions/profile_action.php" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input class="form-control" name="full_name" value="<?= e($user['full_name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input class="form-control" name="phone" value="<?= e($user['phone'] ?? '') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" value="<?= e($user['email'] ?? '') ?>" disabled>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="3"><?= e($user['address'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
