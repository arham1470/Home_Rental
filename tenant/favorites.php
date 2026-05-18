<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['tenant']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('
    SELECT f.property_id, p.title, p.location, p.price, p.property_type
    FROM favorites f
    INNER JOIN properties p ON p.id = f.property_id
    WHERE f.tenant_id = :tenant_id
    ORDER BY f.id DESC
');
$stmt->execute([':tenant_id' => (int)$_SESSION['user_id']]);
$favorites = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">My Favorites</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (!$favorites): ?>
                        <p class="text-muted mb-0">No favorite properties yet.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($favorites as $item): ?>
                                        <tr>
                                            <td><?= e($item['title']) ?></td>
                                            <td><?= e($item['location']) ?></td>
                                            <td><?= e($item['property_type']) ?></td>
                                            <td>$<?= e(number_format((float)$item['price'], 2)) ?></td>
                                            <td>
                                                <form action="<?= BASE_URL ?>/actions/favorite_action.php" method="post" class="d-inline">
                                                    <input type="hidden" name="action" value="remove">
                                                    <input type="hidden" name="property_id" value="<?= (int)$item['property_id'] ?>">
                                                    <button class="btn btn-sm btn-outline-danger">Remove</button>
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
