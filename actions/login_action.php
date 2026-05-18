<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/login.php');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    set_flash('danger', 'Email and password are required.');
    redirect(BASE_URL . '/login.php');
}

try {
    $pdo = getDB();
    $stmt = $pdo->prepare('SELECT id, full_name, email, password_hash, role, is_active FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        set_flash('danger', 'Invalid login credentials.');
        redirect(BASE_URL . '/login.php');
    }

    if ((int)$user['is_active'] !== 1) {
        set_flash('danger', 'Your account is inactive.');
        redirect(BASE_URL . '/login.php');
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'tenant') {
        redirect(BASE_URL . '/tenant/dashboard.php');
    }
    if ($user['role'] === 'landlord') {
        redirect(BASE_URL . '/landlord/dashboard.php');
    }
    if ($user['role'] === 'admin') {
        redirect(BASE_URL . '/admin/dashboard.php');
    }

    redirect(BASE_URL . '/index.php');
} catch (Throwable $e) {
    set_flash('danger', 'Login failed. Please try again.');
    redirect(BASE_URL . '/login.php');
}
