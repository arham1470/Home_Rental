<?php
require_once __DIR__ . '/config/db.php';

/*
 One-time password setup utility for demo accounts (admin, tenant, landlord).
 Run in browser: http://localhost/Home_Rental/setpassword.php
 After successful setup, DELETE this file for security.
*/

try {
    $pdo = getDB();

    $accounts = [
        [
            'full_name' => 'System Admin',
            'email' => 'admin@homerenting.com',
            'role' => 'admin',
            'password' => 'Admin@123',
            'phone' => '01700000001',
            'address' => 'Admin Office'
        ],
        [
            'full_name' => 'Demo Tenant',
            'email' => 'tenant@homerenting.com',
            'role' => 'tenant',
            'password' => 'Tenant@123',
            'phone' => '01700000002',
            'address' => 'Tenant Address'
        ],
        [
            'full_name' => 'Demo Landlord',
            'email' => 'landlord@homerenting.com',
            'role' => 'landlord',
            'password' => 'Landlord@123',
            'phone' => '01700000003',
            'address' => 'Landlord Address'
        ],
    ];

    $selectStmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $insertStmt = $pdo->prepare(
        'INSERT INTO users (full_name, email, phone, password_hash, role, address, is_active)
         VALUES (:full_name, :email, :phone, :password_hash, :role, :address, 1)'
    );
    $updateStmt = $pdo->prepare(
        'UPDATE users
         SET full_name = :full_name, phone = :phone, password_hash = :password_hash, role = :role, address = :address, is_active = 1
         WHERE email = :email'
    );

    $results = [];

    foreach ($accounts as $account) {
        $hashedPassword = password_hash($account['password'], PASSWORD_DEFAULT);

        $selectStmt->execute([':email' => $account['email']]);
        $existing = $selectStmt->fetch();

        if ($existing) {
            $updateStmt->execute([
                ':full_name' => $account['full_name'],
                ':phone' => $account['phone'],
                ':password_hash' => $hashedPassword,
                ':role' => $account['role'],
                ':address' => $account['address'],
                ':email' => $account['email']
            ]);
            $results[] = "Updated: {$account['email']} ({$account['role']})";
        } else {
            $insertStmt->execute([
                ':full_name' => $account['full_name'],
                ':email' => $account['email'],
                ':phone' => $account['phone'],
                ':password_hash' => $hashedPassword,
                ':role' => $account['role'],
                ':address' => $account['address']
            ]);
            $results[] = "Created: {$account['email']} ({$account['role']})";
        }
    }
} catch (Throwable $e) {
    http_response_code(500);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Set Password - Error</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 2rem; background: #f8f9fa; }
            .box { background: #fff; border: 1px solid #ddd; padding: 1rem 1.25rem; border-radius: 8px; max-width: 800px; }
            .error { color: #b00020; }
        </style>
    </head>
    <body>
        <div class="box">
            <h2 class="error">Password setup failed</h2>
            <p><?= htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') ?></p>
            <p>Check database connection and table structure, then try again.</p>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Set Password - Success</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; background: #f8f9fa; }
        .box { background: #fff; border: 1px solid #ddd; padding: 1rem 1.25rem; border-radius: 8px; max-width: 800px; }
        h2 { margin-top: 0; color: #0f5132; }
        code { background: #f1f3f5; padding: 2px 6px; border-radius: 4px; }
        ul { margin-top: .5rem; }
        .warn { color: #8a6d3b; font-weight: 600; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Demo account passwords configured successfully</h2>
        <ul>
            <?php foreach ($results as $line): ?>
                <li><?= htmlspecialchars($line, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Login Credentials</h3>
        <ul>
            <li><strong>Admin:</strong> <code>admin@homerenting.com</code> / <code>Admin@123</code></li>
            <li><strong>Tenant:</strong> <code>tenant@homerenting.com</code> / <code>Tenant@123</code></li>
            <li><strong>Landlord:</strong> <code>landlord@homerenting.com</code> / <code>Landlord@123</code></li>
        </ul>

        <p class="warn">Security Note: Delete <code>setpassword.php</code> after use.</p>
    </div>
</body>
</html>
