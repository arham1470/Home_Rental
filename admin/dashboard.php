<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role(['admin']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';

$pdo = getDB();

$counts = [
    'users' => 0,
    'properties' => 0,
    'bookings' => 0,
    'inquiries' => 0
];

$counts['users'] = (int)($pdo->query('SELECT COUNT(*) FROM users')->fetchColumn() ?: 0);
$counts['properties'] = (int)($pdo->query('SELECT COUNT(*) FROM properties')->fetchColumn() ?: 0);
$counts['bookings'] = (int)($pdo->query('SELECT COUNT(*) FROM booking_requests')->fetchColumn() ?: 0);
$counts['inquiries'] = (int)($pdo->query('SELECT COUNT(*) FROM inquiries')->fetchColumn() ?: 0);
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3">
            <?php require __DIR__ . '/../includes/sidebar.php'; ?>
        </div>

        <div class="col-lg-9">
            <section class="admin-hero p-4 p-lg-5 mb-4" data-aos="fade-up">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    <div>
                        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-2">Admin Control Center</span>
                        <h1 class="h3 mb-2 fw-bold text-dark">Welcome back, Administrator</h1>
                        <p class="mb-0 text-secondary">
                            Monitor users, properties, bookings, and system communication from one centralized dashboard.
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASE_URL ?>/admin/users.php" class="btn btn-search px-3">Manage Users</a>
                        <a href="<?= BASE_URL ?>/admin/properties.php" class="btn btn-outline-primary px-3">Manage Properties</a>
                    </div>
                </div>
            </section>

            <section class="row g-3 mb-4">
                <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="50">
                    <div class="kpi-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="kpi-label mb-1">Total Users</p>
                                <h3 class="kpi-value mb-0"><?= $counts['users'] ?></h3>
                            </div>
                            <span class="kpi-icon"><i class="bi bi-people"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="kpi-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="kpi-label mb-1">Properties</p>
                                <h3 class="kpi-value mb-0"><?= $counts['properties'] ?></h3>
                            </div>
                            <span class="kpi-icon"><i class="bi bi-houses"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="150">
                    <div class="kpi-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="kpi-label mb-1">Bookings</p>
                                <h3 class="kpi-value mb-0"><?= $counts['bookings'] ?></h3>
                            </div>
                            <span class="kpi-icon"><i class="bi bi-calendar-check"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="kpi-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="kpi-label mb-1">Inquiries</p>
                                <h3 class="kpi-value mb-0"><?= $counts['inquiries'] ?></h3>
                            </div>
                            <span class="kpi-icon"><i class="bi bi-chat-dots"></i></span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-3">
                <div class="col-lg-7" data-aos="fade-up">
                    <div class="snapshot-card h-100">
                        <h5 class="fw-bold mb-3">System Snapshot</h5>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="mini-stat">
                                    <p class="mini-label mb-1">User to Property Ratio</p>
                                    <h6 class="mb-0">
                                        <?= $counts['properties'] > 0 ? number_format($counts['users'] / $counts['properties'], 2) : '0.00' ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mini-stat">
                                    <p class="mini-label mb-1">Booking Load</p>
                                    <h6 class="mb-0">
                                        <?= $counts['properties'] > 0 ? number_format(($counts['bookings'] / $counts['properties']) * 100, 1) : '0.0' ?>%
                                    </h6>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mini-stat">
                                    <p class="mini-label mb-1">Inquiry Rate</p>
                                    <h6 class="mb-0">
                                        <?= $counts['users'] > 0 ? number_format(($counts['inquiries'] / $counts['users']) * 100, 1) : '0.0' ?>%
                                    </h6>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mini-stat">
                                    <p class="mini-label mb-1">Platform Health</p>
                                    <h6 class="mb-0 text-success">Stable</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="80">
                    <div class="snapshot-card h-100">
                        <h5 class="fw-bold mb-3">Quick Management</h5>
                        <div class="d-grid gap-2">
                            <a class="quick-link-card" href="<?= BASE_URL ?>/admin/users.php">
                                <span><i class="bi bi-person-gear me-2"></i> Manage Users</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <a class="quick-link-card" href="<?= BASE_URL ?>/admin/properties.php">
                                <span><i class="bi bi-building-gear me-2"></i> Manage Properties</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <a class="quick-link-card" href="<?= BASE_URL ?>/admin/bookings.php">
                                <span><i class="bi bi-journal-check me-2"></i> Review Bookings</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <a class="quick-link-card" href="<?= BASE_URL ?>/admin/reports.php">
                                <span><i class="bi bi-bar-chart-line me-2"></i> View Reports</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
