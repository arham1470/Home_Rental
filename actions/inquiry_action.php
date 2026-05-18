<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/contact.php');
}

$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');
$propertyId = (int)($_POST['property_id'] ?? 0);
$receiverId = (int)($_POST['receiver_id'] ?? 0);

if ($subject === '' || $message === '') {
    set_flash('danger', 'Subject and message are required.');
    redirect(BASE_URL . '/contact.php');
}

try {
    $pdo = getDB();

    $stmt = $pdo->prepare(
        'INSERT INTO inquiries (property_id, sender_id, receiver_id, subject, message, status)
         VALUES (:property_id, :sender_id, :receiver_id, :subject, :message, "open")'
    );
    $stmt->execute([
        ':property_id' => $propertyId > 0 ? $propertyId : null,
        ':sender_id' => (int)$_SESSION['user_id'],
        ':receiver_id' => $receiverId > 0 ? $receiverId : null,
        ':subject' => $subject,
        ':message' => $message
    ]);

    set_flash('success', 'Inquiry submitted successfully.');

    if ($_SESSION['role'] === 'tenant') {
        redirect(BASE_URL . '/tenant/inquiries.php');
    }
    if ($_SESSION['role'] === 'landlord') {
        redirect(BASE_URL . '/landlord/inquiries.php');
    }
    if ($_SESSION['role'] === 'admin') {
        redirect(BASE_URL . '/admin/dashboard.php');
    }

    redirect(BASE_URL . '/contact.php');
} catch (Throwable $e) {
    set_flash('danger', 'Failed to submit inquiry.');
    redirect(BASE_URL . '/contact.php');
}
?>
