<?php
require_once __DIR__ . '/app.php';

function is_logged_in(): bool
{
    return isset($_SESSION['user_id'], $_SESSION['role']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        set_flash('danger', 'Please login first.');
        redirect(BASE_URL . '/login.php');
    }
}

function require_role(array $roles): void
{
    require_login();
    if (!in_array($_SESSION['role'], $roles, true)) {
        set_flash('danger', 'Unauthorized access.');
        redirect(BASE_URL . '/index.php');
    }
}
