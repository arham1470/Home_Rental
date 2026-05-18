<footer class="modern-footer mt-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="footer-brand mb-3">Home<span>Rental</span></h5>
                <p class="footer-text mb-3">
                    A modern home renting platform connecting tenants and landlords directly with trust, transparency, and speed.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= BASE_URL ?>/index.php">Home</a></li>
                    <li><a href="<?= BASE_URL ?>/search.php">Properties</a></li>
                    <li><a href="<?= BASE_URL ?>/contact.php">Contact</a></li>
                    <li><a href="<?= BASE_URL ?>/login.php">Login</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="footer-title">Support</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Report Listing</a></li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6 class="footer-title">Stay Updated</h6>
                <p class="footer-text">Get latest property listings and renting tips.</p>
                <form class="newsletter-form">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email" aria-label="Email">
                        <button class="btn btn-newsletter" type="button">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="footer-divider my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="mb-0 small">&copy; <?= date('Y') ?> <?= e(APP_NAME) ?>. All rights reserved.</p>
            <small class="text-light-emphasis">Built with PHP, MySQL, Bootstrap 5</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="<?= BASE_URL ?>/assets/js/app.js"></script>
</body>
</html>
