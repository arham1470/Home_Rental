<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
require_once __DIR__ . '/includes/flash.php';

$propertyId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
?>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <img src="https://picsum.photos/seed/details<?= $propertyId ?: 1 ?>/1200/620" class="property-thumb rounded-top-4" alt="Property">
                <div class="card-body p-4">
                    <span class="badge badge-soft mb-2">Verified Listing</span>
                    <h2 class="h4">Modern Family Apartment</h2>
                    <p class="text-muted mb-2">Location: Downtown, City Center</p>
                    <p class="mb-3">
                        Spacious and modern apartment with natural light, secure parking,
                        and easy access to public transportation.
                    </p>
                    <div class="row g-3">
                        <div class="col-md-4"><strong>Type:</strong> Apartment</div>
                        <div class="col-md-4"><strong>Rooms:</strong> 3</div>
                        <div class="col-md-4"><strong>Rent:</strong> $500/month</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5>Interested in this property?</h5>
                    <p class="text-muted small">Send request or save to favorites.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Send Rental Request</button>
                        <button class="btn btn-outline-secondary" type="button">Add to Favorites</button>
                        <a href="<?= BASE_URL ?>/contact.php" class="btn btn-outline-dark">Contact Landlord</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
