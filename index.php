<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="hero-section py-5 border-bottom">
    <div class="container py-lg-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-6" data-aos="fade-up">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-3">Trusted Home Renting Platform</span>
                <h1 class="display-4 fw-bold hero-title mb-3">Find Your Next Home <br>Without Broker Hassles</h1>
                <p class="hero-subtitle mb-4">
                    Rent smarter with verified listings, direct landlord communication, transparent pricing, and fast rental requests.
                </p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="search.php" class="btn btn-search px-4">Browse Properties</a>
                    <a href="register.php" class="btn btn-outline-primary px-4">Get Started</a>
                </div>

                <div class="row g-3">
                    <div class="col-4">
                        <div class="metric-card">
                            <h3 data-counter="12000">0</h3>
                            <p>Properties</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="metric-card">
                            <h3 data-counter="3400">0</h3>
                            <p>Landlords</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="metric-card">
                            <h3 data-counter="24">0</h3>
                            <p>Support</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image-card">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80" alt="Modern apartment">
                    <div class="stat-float stat-1">
                        <h6>12K+ Listings</h6>
                        <p>Across top cities</p>
                    </div>
                    <div class="stat-float stat-2">
                        <h6>Verified Owners</h6>
                        <p>Trusted profiles</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 mx-auto" data-aos="fade-up">
                <div class="quick-search-card bg-white p-4">
                    <h5 class="mb-3 fw-bold text-dark">Quick Search</h5>
                    <form action="search.php" method="get" class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Location</label>
                            <div class="input-icon-group">
                                <i class="bi bi-geo-alt"></i>
                                <input type="text" name="location" class="form-control" placeholder="Enter city or area">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Min Price</label>
                            <div class="input-icon-group">
                                <i class="bi bi-currency-dollar"></i>
                                <input type="number" name="min_price" class="form-control" min="0" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Max Price</label>
                            <div class="input-icon-group">
                                <i class="bi bi-currency-dollar"></i>
                                <input type="number" name="max_price" class="form-control" min="0" placeholder="100000">
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button class="btn btn-search w-100" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="mb-4 text-center" data-aos="fade-up">
            <h2 class="section-title">Why Choose Home Renting System?</h2>
            <p class="section-subtitle mx-auto">A professional renting platform designed for trust, speed, and simplicity.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="50">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <span class="feature-icon"><i class="bi bi-people"></i></span>
                        <h5 class="card-title fw-bold">Direct Connection</h5>
                        <p class="card-text text-muted">Tenants connect directly with landlords without broker dependency.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="120">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <span class="feature-icon"><i class="bi bi-funnel"></i></span>
                        <h5 class="card-title fw-bold">Smart Search</h5>
                        <p class="card-text text-muted">Filter homes by location, price, rooms, property type, and amenities.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="180">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <span class="feature-icon"><i class="bi bi-shield-check"></i></span>
                        <h5 class="card-title fw-bold">Secure Workflow</h5>
                        <p class="card-text text-muted">Role-based access, secure authentication, and protected booking flow.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light-subtle">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" data-aos="fade-up">
            <div>
                <h2 class="section-title mb-1">Featured Properties</h2>
                <p class="section-subtitle mb-0">Handpicked listings from verified landlords.</p>
            </div>
            <a href="search.php" class="btn btn-outline-primary">View All</a>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=900&q=80" class="property-thumb" alt="Property 1">
                    <div class="card-body">
                        <h5 class="fw-bold">Modern Family Apartment</h5>
                        <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> Dhaka, Banani</p>
                        <p class="fw-semibold text-primary mb-0">৳ 35,000 / month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="80">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80" class="property-thumb" alt="Property 2">
                    <div class="card-body">
                        <h5 class="fw-bold">Cozy Studio Flat</h5>
                        <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> Chattogram, GEC</p>
                        <p class="fw-semibold text-primary mb-0">৳ 18,000 / month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="130">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=80" class="property-thumb" alt="Property 3">
                    <div class="card-body">
                        <h5 class="fw-bold">Luxury Duplex House</h5>
                        <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> Sylhet, Zindabazar</p>
                        <p class="fw-semibold text-primary mb-0">৳ 75,000 / month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle mx-auto">Rent in 3 simple steps.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <span class="feature-icon"><i class="bi bi-search"></i></span>
                        <h5 class="fw-bold">1. Search</h5>
                        <p class="text-muted mb-0">Find homes by location, budget, and facilities in seconds.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <span class="feature-icon"><i class="bi bi-chat-dots"></i></span>
                        <h5 class="fw-bold">2. Contact</h5>
                        <p class="text-muted mb-0">Talk directly to landlords and send booking requests easily.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="160">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <span class="feature-icon"><i class="bi bi-house-check"></i></span>
                        <h5 class="fw-bold">3. Move In</h5>
                        <p class="text-muted mb-0">Finalize approval and move into your chosen home confidently.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light-subtle">
    <div class="container">
        <div class="text-center mb-4" data-aos="fade-up">
            <h2 class="section-title">What Users Say</h2>
            <p class="section-subtitle mx-auto">Trusted by tenants and landlords nationwide.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="mb-3">“I found a verified apartment in two days. The direct contact saved me broker fees.”</p>
                        <h6 class="mb-0 fw-bold">Nusrat Jahan</h6>
                        <small class="text-muted">Tenant</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="90">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="mb-3">“Managing listings and requests is very smooth. Dashboard is simple and professional.”</p>
                        <h6 class="mb-0 fw-bold">Rahim Uddin</h6>
                        <small class="text-muted">Landlord</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="140">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="mb-3">“The platform gives complete visibility and helps verify activity effectively.”</p>
                        <h6 class="mb-0 fw-bold">Admin Team</h6>
                        <small class="text-muted">System Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
