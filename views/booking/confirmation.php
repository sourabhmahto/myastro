<?php
/**
 * Booking Confirmation & Printable Voucher View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner no-print">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('booking') ?>" class="text-white-50">Booking</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Confirmation</li>
            </ol>
        </nav>
        <h1>Pilgrimage Darshan Pass &amp; Confirmation</h1>
        <p class="mb-0">Your Vedic Pooja has been successfully scheduled at Shree Omkareshwar Jyotirlinga.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <!-- Actions Bar (Screen only) -->
        <div class="text-center mb-4 no-print">
            <div class="d-inline-flex flex-wrap gap-2 justify-content-center">
                <button type="button" class="btn-crimson" id="print-voucher-btn">
                    <i class="bi bi-printer-fill me-2"></i>Print Official Darshan Pass
                </button>
                <button type="button" class="btn-whatsapp" id="whatsapp-share-btn"
                    data-booking="<?= e($booking['booking_number']) ?>"
                    data-name="<?= e($booking['customer_name']) ?>"
                    data-pooja="<?= e($booking['pooja_name']) ?>"
                    data-date="<?= format_date($booking['booking_date']) ?> at <?= e($booking['booking_time']) ?>">
                    <i class="bi bi-whatsapp me-2"></i>Share on WhatsApp
                </button>
                <a href="<?= url('booking/track') ?>" class="btn-outline-crimson text-decoration-none">
                    <i class="bi bi-search me-1"></i>Track Booking Status
                </a>
            </div>
        </div>

        <!-- Printable Voucher Card -->
        <div class="booking-voucher shadow-lg">
            <div class="voucher-header">
                <div class="om-text" style="font-size:2.8rem;color:#FDE68A;line-height:1;">ॐ नमः शिवाय</div>
                <h2 class="text-white">SHREE OMKARESHWAR JYOTIRLINGA</h2>
                <div class="text-white-50" style="font-size:0.85rem;letter-spacing:1.5px;text-transform:uppercase;">Official Pilgrimage Darshan &amp; Pooja Pass</div>
                <div class="voucher-booking-id">
                    <?= e($booking['booking_number']) ?>
                </div>
            </div>

            <div class="voucher-body">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <span class="text-slate">Pass Status:</span>
                    <span class="voucher-status-badge status-<?= e($booking['booking_status']) ?>">
                        <i class="bi bi-check-circle-fill"></i> <?= strtoupper(e($booking['booking_status'])) ?>
                    </span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-flower1 text-gold me-1"></i>Pooja / Seva:</span>
                    <span class="value fs-6 text-crimson fw-bold"><?= e($booking['pooja_name']) ?></span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-calendar-event text-gold me-1"></i>Scheduled Date:</span>
                    <span class="value fw-bold"><?= format_date($booking['booking_date']) ?></span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-clock text-gold me-1"></i>Time Slot:</span>
                    <span class="value fw-bold"><?= e($booking['booking_time']) ?></span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-person text-gold me-1"></i>Devotee Name:</span>
                    <span class="value"><?= e($booking['customer_name']) ?></span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-telephone text-gold me-1"></i>Contact Number:</span>
                    <span class="value"><?= e($booking['customer_phone']) ?></span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-envelope text-gold me-1"></i>Email Address:</span>
                    <span class="value"><?= e($booking['customer_email']) ?></span>
                </div>

                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-cash-stack text-gold me-1"></i>Dakshina (Amount):</span>
                    <span class="value fw-bold text-crimson"><?= format_currency($booking['amount']) ?> (<?= strtoupper(str_replace('_', ' ', e($booking['payment_status']))) ?>)</span>
                </div>

                <?php if (!empty($booking['special_requests'])): ?>
                <div class="voucher-detail-row">
                    <span class="label"><i class="bi bi-card-text text-gold me-1"></i>Sankalp / Notes:</span>
                    <span class="value"><?= e($booking['special_requests']) ?></span>
                </div>
                <?php endif; ?>

                <div class="p-3 bg-gold-pale rounded-3 border mt-4">
                    <h6 class="text-crimson mb-2"><i class="bi bi-geo-alt-fill text-gold me-1"></i>Reporting Guidelines</h6>
                    <ul class="mb-0 text-slate" style="font-size:0.85rem;padding-left:1.2rem;">
                        <li>Report at <strong>Mandhata Island Temple Seva Counter #2 (Near Jhula Pul Gate)</strong> 30 minutes prior to your time slot.</li>
                        <li>Please present this printed pass or show the digital confirmation on your mobile phone to the coordinator.</li>
                        <li>For any instant assistance, reach the priest coordinator on helpline: <strong><?= e(CONTACT_PHONE) ?></strong>.</li>
                    </ul>
                </div>
            </div>

            <div class="voucher-footer">
                <div class="note mb-1">HAR HAR MAHADEV &bull; SHREE OMKARESHWAR MAHARAJ KI JAI</div>
                <div>Mandhata Island, Khandwa District, Madhya Pradesh - 450554 &bull; <?= e(CONTACT_PHONE) ?></div>
            </div>
        </div>

        <div class="text-center mt-4 no-print">
            <a href="<?= url() ?>" class="btn-outline-crimson text-decoration-none">
                <i class="bi bi-house-door me-1"></i>Return to Home
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
