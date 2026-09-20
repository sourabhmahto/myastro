<?php
/**
 * Track Booking & Darshan Pass View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Track Booking</li>
            </ol>
        </nav>
        <h1>Track Pilgrimage Booking &amp; Darshan Pass</h1>
        <p class="mb-0">Check your booking status, view schedule, or reprint your official Darshan pass.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Search Box -->
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border mb-4" style="border-top:4px solid var(--color-gold) !important;">
                    <h4 class="text-crimson mb-3 text-center"><i class="bi bi-search text-gold me-2"></i>Booking Lookup</h4>
                    
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= e($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <form action="<?= url('booking/track') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="booking_number" class="form-label fw-bold">Booking Reference Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="booking_number" name="booking_number" placeholder="e.g. OMK-2026-8491" required value="<?= e($_POST['booking_number'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label fw-bold">Registered Mobile or Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Mobile number or Email ID used during booking" required value="<?= e($_POST['contact'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn-crimson w-100 py-2 fw-bold">
                            <i class="bi bi-search me-1"></i>Search Booking Status
                        </button>
                    </form>
                </div>

                <!-- Result Card -->
                <?php if ($searched && $booking): ?>
                <div class="bg-white p-4 rounded-3 shadow-sm border" style="border-left:5px solid #059669 !important;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-slate">Booking #<strong><?= e($booking['booking_number']) ?></strong></span>
                        <span class="voucher-status-badge status-<?= e($booking['booking_status']) ?>">
                            <?= strtoupper(e($booking['booking_status'])) ?>
                        </span>
                    </div>

                    <h5 class="text-crimson mb-1"><?= e($booking['pooja_name']) ?></h5>
                    <div class="text-slate mb-3" style="font-size:0.9rem;">
                        <i class="bi bi-calendar-event text-gold me-1"></i><?= format_date($booking['booking_date']) ?> at <?= e($booking['booking_time']) ?>
                    </div>

                    <div class="p-3 bg-ivory rounded-2 mb-3" style="font-size:0.88rem;">
                        <div><strong>Devotee:</strong> <?= e($booking['customer_name']) ?></div>
                        <div><strong>Contact:</strong> <?= e($booking['customer_phone']) ?> | <?= e($booking['customer_email']) ?></div>
                        <div><strong>Amount:</strong> <?= format_currency($booking['amount']) ?> (<?= strtoupper(str_replace('_', ' ', e($booking['payment_status']))) ?>)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="<?= url('booking/confirmation?booking_number=' . urlencode($booking['booking_number'])) ?>" class="btn-gold flex-fill text-center text-decoration-none">
                            <i class="bi bi-printer me-1"></i>View / Print Pass
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
