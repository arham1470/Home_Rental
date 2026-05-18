<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['landlord']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->prepare('
    SELECT id, title, location, property_type, price, status, created_at
    FROM properties
    WHERE landlord_id = :landlord_id
    ORDER BY id DESC
');
$stmt->execute([':landlord_id' => (int)$_SESSION['user_id']]);
$properties = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Manage Properties</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (!$properties): ?>
                        <p class="text-muted mb-0">No properties found.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($properties as $property): ?>
                                        <tr>
                                            <td>#<?= (int)$property['id'] ?></td>
                                            <td><?= e($property['title']) ?></td>
                                            <td><?= e($property['location']) ?></td>
                                            <td><?= e($property['property_type']) ?></td>
                                            <td>$<?= e(number_format((float)$property['price'], 2)) ?></td>
                                            <td><span class="badge bg-secondary"><?= e($property['status']) ?></span></td>
                                            <td class="text-end">
                                                <a href="<?= BASE_URL ?>/property-details.php?id=<?= (int)$property['id'] ?>" class="btn btn-sm btn-outline-primary">View</a>
                                                <form action="<?= BASE_URL ?>/actions/property_action.php" method="post" class="d-inline">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="property_id" value="<?= (int)$property['id'] ?>">
                                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this property?')">Delete</button>
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
