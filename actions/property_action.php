<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';

require_role(['landlord', 'admin']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/landlord/manage-properties.php');
}

$action = $_POST['action'] ?? '';
$pdo = getDB();

try {
    if ($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $propertyType = $_POST['property_type'] ?? 'apartment';
        $price = (float)($_POST['price'] ?? 0);
        $rooms = (int)($_POST['rooms'] ?? 1);
        $bathrooms = (int)($_POST['bathrooms'] ?? 1);
        $areaSqft = (int)($_POST['area_sqft'] ?? 0);
        $amenities = trim($_POST['amenities'] ?? '');

        if ($title === '' || $description === '' || $location === '' || $price <= 0) {
            set_flash('danger', 'Please fill all required property fields.');
            redirect(BASE_URL . '/landlord/add-property.php');
        }

        $allowedTypes = ['apartment', 'house', 'studio', 'villa', 'office', 'other'];
        if (!in_array($propertyType, $allowedTypes, true)) {
            $propertyType = 'other';
        }

        $stmt = $pdo->prepare('
            INSERT INTO properties
            (landlord_id, title, description, location, property_type, price, rooms, bathrooms, area_sqft, amenities, status, is_approved)
            VALUES
            (:landlord_id, :title, :description, :location, :property_type, :price, :rooms, :bathrooms, :area_sqft, :amenities, "available", 1)
        ');
        $stmt->execute([
            ':landlord_id' => (int)$_SESSION['user_id'],
            ':title' => $title,
            ':description' => $description,
            ':location' => $location,
            ':property_type' => $propertyType,
            ':price' => $price,
            ':rooms' => $rooms > 0 ? $rooms : 1,
            ':bathrooms' => $bathrooms > 0 ? $bathrooms : 1,
            ':area_sqft' => $areaSqft > 0 ? $areaSqft : null,
            ':amenities' => $amenities
        ]);

        set_flash('success', 'Property added successfully.');
        redirect(BASE_URL . '/landlord/manage-properties.php');
    }

    if ($action === 'delete') {
        $propertyId = (int)($_POST['property_id'] ?? 0);
        if ($propertyId <= 0) {
            set_flash('danger', 'Invalid property.');
            redirect(BASE_URL . '/landlord/manage-properties.php');
        }

        if ($_SESSION['role'] === 'admin') {
            $stmt = $pdo->prepare('DELETE FROM properties WHERE id = :id');
            $stmt->execute([':id' => $propertyId]);
        } else {
            $stmt = $pdo->prepare('DELETE FROM properties WHERE id = :id AND landlord_id = :landlord_id');
            $stmt->execute([
                ':id' => $propertyId,
                ':landlord_id' => (int)$_SESSION['user_id']
            ]);
        }

        set_flash('success', 'Property deleted successfully.');
        redirect(BASE_URL . '/landlord/manage-properties.php');
    }

    if ($action === 'update_status' && $_SESSION['role'] === 'admin') {
        $propertyId = (int)($_POST['property_id'] ?? 0);
        $approved = (int)($_POST['is_approved'] ?? 1);
        $stmt = $pdo->prepare('UPDATE properties SET is_approved = :approved WHERE id = :id');
        $stmt->execute([
            ':approved' => $approved ? 1 : 0,
            ':id' => $propertyId
        ]);

        set_flash('success', 'Property moderation updated.');
        redirect(BASE_URL . '/admin/properties.php');
    }

    set_flash('warning', 'Invalid property action.');
    redirect(BASE_URL . '/landlord/manage-properties.php');
} catch (Throwable $e) {
    set_flash('danger', 'Property action failed.');
    redirect(BASE_URL . '/landlord/manage-properties.php');
}
?>
