<?php
require_once __DIR__ . '/../config/auth.php';
require_role(['landlord']);
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/flash.php';
?>

<div class="container py-4 dashboard-wrapper">
    <div class="row g-4">
        <div class="col-lg-3"><?php require __DIR__ . '/../includes/sidebar.php'; ?></div>
        <div class="col-lg-9">
            <h2 class="h4 mb-3">Add Property</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="<?= BASE_URL ?>/actions/property_action.php" method="post">
                        <input type="hidden" name="action" value="add">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input name="title" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Location</label>
                                <input name="location" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Type</label>
                                <select name="property_type" class="form-select">
                                    <option value="apartment">Apartment</option>
                                    <option value="house">House</option>
                                    <option value="studio">Studio</option>
                                    <option value="villa">Villa</option>
                                    <option value="office">Office</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" min="1" step="0.01" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Rooms</label>
                                <input type="number" name="rooms" class="form-control" min="1" value="1">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Baths</label>
                                <input type="number" name="bathrooms" class="form-control" min="1" value="1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area (sqft)</label>
                                <input type="number" name="area_sqft" class="form-control" min="0">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Amenities</label>
                                <input name="amenities" class="form-control" placeholder="WiFi, Parking, Lift">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit Property</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
