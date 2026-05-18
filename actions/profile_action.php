<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/index.php');
}

$fullName = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');

if ($fullName === '' || $phone === '') {
    set_flash('danger', 'Name and phone are required.');
    redirect(BASE_URL . '/tenant/profile.php');
}

try {
    $pdo = getDB();
    $stmt = $pdo->prepare('UPDATE users SET full_name = :full_name, phone = :phone, address = :address WHERE id = :id');
    $stmt->execute([
        ':full_name' => $fullName,
        ':phone' => $phone,
        ':address' => $address,
        ':id' => $_SESSION['user_id']
    ]);

    $_SESSION['full_name'] = $fullName;
    set_flash('success', 'Profile updated successfully.');

    if ($_SESSION['role'] === 'landlord') {
        redirect(BASE_URL . '/landlord/dashboard.php');
    }
    if ($_SESSION['role'] === 'admin') {
        redirect(BASE_URL . '/admin/dashboard.php');
    }

    redirect(BASE_URL . '/tenant/profile.php');
} catch (Throwable $e) {
    set_flash('danger', 'Profile update failed.');
    redirect(BASE_URL . '/tenant/profile.php');
}
