<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['admin']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();
$stmt = $pdo->query('
    SELECT p.id, p.title, p.location, p.price, p.status, p.created_at, u.full_name AS landlord_name
    FROM properties p
    INNER JOIN users u ON u.id = p.landlord_id
    ORDER BY p.id DESC
');
$properties = $stmt->fetchAll();
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Manage Properties</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Landlord</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($properties as $property): ?>
                                    <tr>
                                        <td>#<?= (int)$property['id'] ?></td>
                                        <td><?= e($property['title']) ?></td>
                                        <td><?= e($property['landlord_name']) ?></td>
                                        <td><?= e($property['location']) ?></td>
                                        <td>$<?= e(number_format((float)$property['price'], 2)) ?></td>
                                        <td><span class="badge bg-secondary"><?= e($property['status']) ?></span></td>
                                        <td class="text-end">
                                            <form class="d-inline" action="<?= BASE_URL ?>/actions/property_action.php" method="post">
                                                <input type="hidden" name="action" value="update_status">
                                                <input type="hidden" name="property_id" value="<?= (int)$property['id'] ?>">
                                                <input type="hidden" name="status" value="available">
                                                <button class="btn btn-sm btn-outline-success">Approve</button>
                                            </form>
                                            <form class="d-inline" action="<?= BASE_URL ?>/actions/property_action.php" method="post">
                                                <input type="hidden" name="action" value="update_status">
                                                <input type="hidden" name="property_id" value="<?= (int)$property['id'] ?>">
                                                <input type="hidden" name="status" value="rejected">
                                                <button class="btn btn-sm btn-outline-warning">Reject</button>
                                            </form>
                                            <form class="d-inline" action="<?= BASE_URL ?>/actions/property_action.php" method="post">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="property_id" value="<?= (int)$property['id'] ?>">
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
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
?>
