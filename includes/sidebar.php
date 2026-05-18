<?php require_once __DIR__ . '/../config/app.php'; ?>
<?php $role = $_SESSION['role'] ?? ''; ?>

<aside class="bg-white border rounded-3 p-3 shadow-sm">
    <h6 class="text-uppercase text-muted mb-3"><?= e($role) ?> Menu</h6>
    <div class="list-group list-group-flush">
        <?php if ($role === 'tenant'): ?>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/tenant/dashboard.php">Dashboard</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/tenant/profile.php">Profile</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/tenant/favorites.php">Favorites</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/tenant/requests.php">Requests</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/tenant/inquiries.php">Inquiries</a>
        <?php elseif ($role === 'landlord'): ?>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/landlord/dashboard.php">Dashboard</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/landlord/add-property.php">Add Property</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/landlord/manage-properties.php">Manage Properties</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/landlord/bookings.php">Bookings</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/landlord/inquiries.php">Inquiries</a>
        <?php elseif ($role === 'admin'): ?>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/admin/dashboard.php">Dashboard</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/admin/users.php">Users</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/admin/properties.php">Properties</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/admin/bookings.php">Bookings</a>
            <a class="list-group-item list-group-item-action" href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
        <?php else: ?>
            <div class="text-muted small">No menu available.</div>
        <?php endif; ?>
    </div>
</aside>
