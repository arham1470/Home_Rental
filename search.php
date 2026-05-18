<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$location = $_GET['location'] ?? '';
$minPrice = $_GET['min_price'] ?? '';
$maxPrice = $_GET['max_price'] ?? '';
?>

<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
        <h2 class="h4 mb-0">Search Properties</h2>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= e($location) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Min Price</label>
                    <input type="number" name="min_price" class="form-control" min="0" value="<?= e((string)$minPrice) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Max Price</label>
                    <input type="number" name="max_price" class="form-control" min="0" value="<?= e((string)$maxPrice) ?>">
                </div>
                <div class="col-md-2 d-grid">
                    <label class="form-label invisible">Search</label>
                    <button class="btn btn-primary" type="submit">Apply</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://picsum.photos/seed/property<?= $i ?>/600/420" alt="Property" class="property-thumb">
                    <div class="card-body">
                        <span class="badge badge-soft mb-2">Sample Listing</span>
                        <h5 class="card-title">Apartment in Prime Area <?= $i ?></h5>
                        <p class="text-muted small mb-2">2 Bed • 1 Bath • 950 sq ft</p>
                        <p class="fw-semibold mb-3">$450/month</p>
                        <a class="btn btn-outline-primary btn-sm" href="<?= BASE_URL ?>/property-details.php?id=<?= $i ?>">View Details</a>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
