<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="hero-section py-5 bg-light border-bottom">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">Find Your Perfect Rental Home</h1>
                <p class="lead text-muted mb-4">
                    Home Renting System connects tenants and landlords directly with transparent listings,
                    secure requests, and easy communication.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="search.php" class="btn btn-primary btn-lg">Browse Properties</a>
                    <a href="register.php" class="btn btn-outline-primary btn-lg">Get Started</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-white shadow-sm rounded-4">
                    <h5 class="mb-3">Quick Search</h5>
                    <form action="search.php" method="get" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Enter city or area">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Min Price</label>
                            <input type="number" name="min_price" class="form-control" min="0" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Max Price</label>
                            <input type="number" name="max_price" class="form-control" min="0" placeholder="100000">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Search Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="h3 mb-4">Why Choose Home Renting System?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Direct Connection</h5>
                        <p class="card-text text-muted">Tenants connect directly with landlords without broker dependency.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Smart Search</h5>
                        <p class="card-text text-muted">Filter properties by location, budget, type, and facilities quickly.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Secure Workflow</h5>
                        <p class="card-text text-muted">Secure login, role-based access, and protected request system.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
