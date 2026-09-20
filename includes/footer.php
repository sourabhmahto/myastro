<?php
/**
 * Shared Footer Include
 * Renders site footer, WhatsApp button, and closing scripts
 */
?>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', CONTACT_PHONE) ?>" target="_blank" rel="noopener noreferrer" class="position-fixed d-flex align-items-center justify-content-center" style="bottom:28px;left:24px;width:52px;height:52px;background:#25D366;border-radius:50%;color:#fff;font-size:1.5rem;box-shadow:0 4px 18px rgba(37,211,102,0.45);z-index:998;text-decoration:none;" aria-label="Chat on WhatsApp" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<!-- Scroll-to-Top Button -->
<button class="scroll-top-btn" aria-label="Scroll to top" title="Back to top">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- ===== SITE FOOTER ===== -->
<footer class="site-footer" role="contentinfo">
    <!-- Temple Timings Banner -->
    <div style="background:linear-gradient(135deg,#7A1C1C,#5C1010);padding:1.5rem 0;border-bottom:2px solid #D97706;">
        <div class="container">
            <div class="row g-3 align-items-center text-white text-center text-md-start">
                <div class="col-md-3">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <i class="bi bi-clock text-warning fs-5"></i>
                        <div>
                            <div style="font-size:0.72rem;letter-spacing:1.5px;text-transform:uppercase;opacity:0.65;">Morning</div>
                            <div style="font-weight:700;font-size:0.95rem;">05:00 AM – 12:00 PM</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <i class="bi bi-sun text-warning fs-5"></i>
                        <div>
                            <div style="font-size:0.72rem;letter-spacing:1.5px;text-transform:uppercase;opacity:0.65;">Afternoon</div>
                            <div style="font-weight:700;font-size:0.95rem;">01:15 PM – 03:30 PM</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <i class="bi bi-moon-stars text-warning fs-5"></i>
                        <div>
                            <div style="font-size:0.72rem;letter-spacing:1.5px;text-transform:uppercase;opacity:0.65;">Evening</div>
                            <div style="font-weight:700;font-size:0.95rem;">04:30 PM – 09:30 PM</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <a href="<?= url('booking') ?>" class="btn-gold d-inline-block text-decoration-none" style="padding:0.55rem 1.4rem;border-radius:25px;">
                        <i class="bi bi-calendar-check me-1"></i>Book Pooja Slot
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Grid -->
    <div class="footer-main">
        <div class="container">
            <div class="row g-4">
                <!-- Brand Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-logo-area">
                        <img src="<?= e(SITE_URL) ?>/assets/images/logo.svg" alt="<?= e(SITE_NAME) ?> Logo" height="52" style="filter:brightness(0) invert(1);">
                    </div>
                    <p class="footer-tagline mt-2">The official digital Seva portal for pilgrimage assistance, Vedic Pooja bookings, and Darshan guidance at Shree Omkareshwar Jyotirlinga, Mandhata Island, MP.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-link" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="<?= url('about') ?>">About Omkareshwar</a></li>
                        <li><a href="<?= url('temples') ?>">Temples & Shrines</a></li>
                        <li><a href="<?= url('pooja-services') ?>">Pooja Services</a></li>
                        <li><a href="<?= url('booking') ?>">Book Online</a></li>
                        <li><a href="<?= url('booking/track') ?>">Track Booking</a></li>
                        <li><a href="<?= url('gallery') ?>">Photo Gallery</a></li>
                        <li><a href="<?= url('blog') ?>">Yatra Blog</a></li>
                    </ul>
                </div>

                <!-- Explore Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Explore</h6>
                    <ul class="footer-links">
                        <li><a href="<?= url('places') ?>">Places to Visit</a></li>
                        <li><a href="<?= url('hotels') ?>">Hotels & Ashrams</a></li>
                        <li><a href="<?= url('contact') ?>">Contact Us</a></li>
                        <li><a href="<?= url('faq') ?>">FAQ</a></li>
                        <li><a href="<?= url('privacy-policy') ?>">Privacy Policy</a></li>
                        <li><a href="<?= url('terms-and-conditions') ?>">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-heading">Seva Kendra Contact</h6>
                    <div class="footer-contact-item">
                        <div class="icon-wrap"><i class="bi bi-geo-alt-fill"></i></div>
                        <span><?= e(OFFICE_ADDRESS) ?></span>
                    </div>
                    <div class="footer-contact-item">
                        <div class="icon-wrap"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <a href="tel:<?= e(CONTACT_PHONE) ?>" class="text-decoration-none text-white-50"><?= e(CONTACT_PHONE) ?></a><br>
                            <a href="tel:<?= e(CONTACT_PHONE_SECONDARY) ?>" class="text-decoration-none text-white-50"><?= e(CONTACT_PHONE_SECONDARY) ?></a>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="icon-wrap"><i class="bi bi-envelope-fill"></i></div>
                        <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="text-decoration-none text-white-50"><?= e(CONTACT_EMAIL) ?></a>
                    </div>
                    <div class="footer-timings-badge">
                        <i class="bi bi-clock-fill me-1" style="color:#D97706;"></i>
                        <strong>Darshan Hours:</strong><br>
                        Morning 5:00 AM – 12:00 PM<br>
                        Evening 4:30 PM – 9:30 PM
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-center">
                <span>
                    &copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved. &nbsp;|&nbsp;
                    Crafted with <span style="color:#D97706;">&#9829;</span> for pilgrims &amp; devotees.
                </span>
                <span class="om-text" style="font-size:1.4rem;color:#D97706;line-height:1;">ॐ नमः शिवाय</span>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom Main JS -->
<script src="<?= e(SITE_URL) ?>/assets/js/main.js"></script>
</body>
</html>
