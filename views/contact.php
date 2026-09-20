<?php
/**
 * Contact Us View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Contact Us</li>
            </ol>
        </nav>
        <h1>Contact Shree Omkareshwar Seva Kendra</h1>
        <p class="mb-0">Reach our dedicated temple assistance desk for pooja inquiries, yatra guidance, and priest coordination.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border" style="border-top:4px solid var(--color-crimson) !important;">
                    <h3 class="text-crimson mb-2">Send Us an Inquiry</h3>
                    <p class="text-slate mb-4" style="font-size:0.92rem;">Have questions about pooja rituals, group yatras, or senior citizen assistance? Submit your message and our seva team will get back to you.</p>

                    <form action="<?= url('contact/send') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="devotee@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold">Mobile Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="+91 98765 43210" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label fw-bold">Your Message / Inquiry <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your inquiry or travel questions in detail..." required></textarea>
                        </div>

                        <button type="submit" class="btn-crimson w-100 py-2 fw-bold" style="font-size:1rem;">
                            <i class="bi bi-send-fill me-1"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Information Sidebar -->
            <div class="col-lg-5">
                <div class="bg-white p-4 rounded-3 shadow-sm border mb-4" style="border-top:4px solid var(--color-gold) !important;">
                    <h4 class="text-crimson mb-3"><i class="bi bi-geo-alt-fill text-gold me-2"></i>Temple Seva Kendra</h4>

                    <div class="mb-3 pb-3 border-bottom">
                        <strong class="d-block text-crimson mb-1">Office Address</strong>
                        <span class="text-slate" style="font-size:0.92rem;"><?= e(OFFICE_ADDRESS) ?></span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <strong class="d-block text-crimson mb-1">Helpline Phone Numbers</strong>
                        <span class="text-slate d-block"><a href="tel:<?= e(CONTACT_PHONE) ?>" class="text-decoration-none text-slate"><i class="bi bi-telephone text-teal me-2"></i><?= e(CONTACT_PHONE) ?> (Primary)</a></span>
                        <span class="text-slate d-block mt-1"><a href="tel:<?= e(CONTACT_PHONE_SECONDARY) ?>" class="text-decoration-none text-slate"><i class="bi bi-telephone text-teal me-2"></i><?= e(CONTACT_PHONE_SECONDARY) ?> (Secondary)</a></span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <strong class="d-block text-crimson mb-1">Email Support</strong>
                        <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="text-decoration-none text-slate"><i class="bi bi-envelope text-gold me-2"></i><?= e(CONTACT_EMAIL) ?></a>
                    </div>

                    <div class="mb-0">
                        <strong class="d-block text-crimson mb-1">Seva Counter Timings</strong>
                        <span class="text-slate" style="font-size:0.9rem;">Monday to Sunday: 05:00 AM to 09:30 PM (Continuous Seva)</span>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="bg-white p-3 rounded-3 shadow-sm border">
                    <h6 class="text-crimson mb-2"><i class="bi bi-map-fill text-gold me-2"></i>Location Map</h6>
                    <div class="ratio ratio-16x9 rounded-2 overflow-hidden">
                        <iframe src="<?= e(GOOGLE_MAPS_EMBED_URL) ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Omkareshwar Location Map"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
