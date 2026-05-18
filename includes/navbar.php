<?php require_once __DIR__ . '/../config/app.php'; ?>
<nav id="mainNav" class="navbar navbar-expand-lg sticky-top modern-navbar">
    <div class="container">
        <a class="navbar-brand brand-logo" href="<?= BASE_URL ?>/index.php">
            Home<span>Rental</span>
        </a>

        <button class="navbar-toggler nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/search.php">Properties</a></li>
                <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/contact.php">Contact</a></li>

                <?php if (!empty($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'tenant'): ?>
                        <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/tenant/dashboard.php">Tenant Dashboard</a></li>
                    <?php elseif ($_SESSION['role'] === 'landlord'): ?>
                        <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/landlord/dashboard.php">Landlord Dashboard</a></li>
                    <?php elseif ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/admin/dashboard.php">Admin Panel</a></li>
                    <?php endif; ?>
                    <li class="nav-item ms-lg-2"><a class="btn btn-sm btn-danger-soft" href="<?= BASE_URL ?>/logout.php"><i class="bi bi-box-arrow-right me-1"></i>Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link modern-nav-link" href="<?= BASE_URL ?>/login.php">Login</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-sm btn-primary-soft" href="<?= BASE_URL ?>/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
