<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';

require_role(['tenant']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/search.php');
}

$action = $_POST['action'] ?? 'add';
$propertyId = (int)($_POST['property_id'] ?? 0);
$tenantId = (int)$_SESSION['user_id'];

if ($propertyId <= 0) {
    set_flash('danger', 'Invalid property selected.');
    redirect(BASE_URL . '/search.php');
}

try {
    $pdo = getDB();

    if ($action === 'remove') {
        $stmt = $pdo->prepare('DELETE FROM favorites WHERE tenant_id = :tenant_id AND property_id = :property_id');
        $stmt->execute([
            ':tenant_id' => $tenantId,
            ':property_id' => $propertyId
        ]);
        set_flash('success', 'Removed from favorites.');
        redirect(BASE_URL . '/tenant/favorites.php');
    }

    $stmt = $pdo->prepare('INSERT IGNORE INTO favorites (tenant_id, property_id) VALUES (:tenant_id, :property_id)');
    $stmt->execute([
        ':tenant_id' => $tenantId,
        ':property_id' => $propertyId
    ]);

    set_flash('success', 'Property added to favorites.');
    redirect(BASE_URL . '/tenant/favorites.php');
} catch (Throwable $e) {
    set_flash('danger', 'Unable to update favorites.');
    redirect(BASE_URL . '/search.php');
}
?>
