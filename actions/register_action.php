<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/register.php');
}

$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'tenant';

if ($fullName === '' || $email === '' || $phone === '' || $password === '') {
    set_flash('danger', 'All fields are required.');
    redirect(BASE_URL . '/register.php');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_flash('danger', 'Please enter a valid email address.');
    redirect(BASE_URL . '/register.php');
}

if (strlen($password) < 6) {
    set_flash('danger', 'Password must be at least 6 characters.');
    redirect(BASE_URL . '/register.php');
}

$allowedRoles = ['tenant', 'landlord'];
if (!in_array($role, $allowedRoles, true)) {
    $role = 'tenant';
}

try {
    $pdo = getDB();

    $checkStmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $checkStmt->execute([':email' => $email]);
    if ($checkStmt->fetch()) {
        set_flash('danger', 'Email already exists.');
        redirect(BASE_URL . '/register.php');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        'INSERT INTO users (full_name, email, phone, password_hash, role) VALUES (:full_name, :email, :phone, :password_hash, :role)'
    );
    $stmt->execute([
        ':full_name' => $fullName,
        ':email' => $email,
        ':phone' => $phone,
        ':password_hash' => $passwordHash,
        ':role' => $role
    ]);

    set_flash('success', 'Registration successful. Please login.');
    redirect(BASE_URL . '/login.php');
} catch (Throwable $e) {
    set_flash('danger', 'Registration failed. Please try again.');
    redirect(BASE_URL . '/register.php');
}
