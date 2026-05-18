<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/index.php');
}

$action = $_POST['action'] ?? '';

try {
    $pdo = getDB();

    if ($action === 'create') {
        require_role(['tenant']);

        $propertyId = (int)($_POST['property_id'] ?? 0);
        $message = trim($_POST['message'] ?? '');
        $moveInDate = trim($_POST['move_in_date'] ?? '');

        if ($propertyId <= 0) {
            set_flash('danger', 'Invalid property selected.');
            redirect(BASE_URL . '/search.php');
        }

        $propertyStmt = $pdo->prepare('SELECT id, landlord_id FROM properties WHERE id = :id AND status = "available" LIMIT 1');
        $propertyStmt->execute([':id' => $propertyId]);
        $property = $propertyStmt->fetch();

        if (!$property) {
            set_flash('danger', 'Property not available for booking.');
            redirect(BASE_URL . '/search.php');
        }

        $stmt = $pdo->prepare(
            'INSERT INTO booking_requests (property_id, tenant_id, landlord_id, message, move_in_date, status)
             VALUES (:property_id, :tenant_id, :landlord_id, :message, :move_in_date, "pending")'
        );
        $stmt->execute([
            ':property_id' => $propertyId,
            ':tenant_id' => (int)$_SESSION['user_id'],
            ':landlord_id' => (int)$property['landlord_id'],
            ':message' => $message,
            ':move_in_date' => $moveInDate !== '' ? $moveInDate : null
        ]);

        set_flash('success', 'Rental request sent successfully.');
        redirect(BASE_URL . '/tenant/requests.php');
    }

    if ($action === 'update_status') {
        require_role(['landlord', 'admin']);

        $requestId = (int)($_POST['request_id'] ?? 0);
        $status = $_POST['status'] ?? 'pending';
        $allowedStatus = ['approved', 'rejected', 'cancelled', 'pending'];

        if ($requestId <= 0 || !in_array($status, $allowedStatus, true)) {
            set_flash('danger', 'Invalid booking update request.');
            redirect(BASE_URL . '/landlord/bookings.php');
        }

        if ($_SESSION['role'] === 'admin') {
            $stmt = $pdo->prepare('UPDATE booking_requests SET status = :status WHERE id = :id');
            $stmt->execute([
                ':status' => $status,
                ':id' => $requestId
            ]);
        } else {
            $stmt = $pdo->prepare('UPDATE booking_requests SET status = :status WHERE id = :id AND landlord_id = :landlord_id');
            $stmt->execute([
                ':status' => $status,
                ':id' => $requestId,
                ':landlord_id' => (int)$_SESSION['user_id']
            ]);
        }

        set_flash('success', 'Booking status updated.');
        redirect($_SESSION['role'] === 'admin' ? BASE_URL . '/admin/bookings.php' : BASE_URL . '/landlord/bookings.php');
    }

    set_flash('warning', 'Invalid booking action.');
    redirect(BASE_URL . '/index.php');
} catch (Throwable $e) {
    set_flash('danger', 'Booking action failed.');
    redirect(BASE_URL . '/index.php');
}
