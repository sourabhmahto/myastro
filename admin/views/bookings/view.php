<?php
/**
 * Admin Booking Detail / Voucher View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Booking Details <span>#<?= e($booking['booking_number']) ?></span></h2>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn-admin-primary" onclick="window.print();">
            <i class="bi bi-printer me-1"></i> Print Receipt
        </button>
        <a href="<?= url('admin?action=bookings') ?>" class="btn-admin-secondary">
            &larr; Back to Bookings
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Voucher -->
    <div class="col-lg-8">
        <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div>
                    <h4 class="text-crimson mb-0">Omkareshwar Jyotirlinga Seva</h4>
                    <small class="text-muted">Darshan Pass &amp; Ritual Registration</small>
                </div>
                <div class="text-end">
                    <span class="badge bg-crimson fs-6 px-3 py-2"><code><?= e($booking['booking_number']) ?></code></span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="text-muted d-block" style="font-size:0.8rem;">Pooja / Seva Name</label>
                    <strong class="fs-5 text-crimson"><?= e($booking['pooja_name']) ?></strong>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block" style="font-size:0.8rem;">Booking Date &amp; Time Slot</label>
                    <strong class="fs-5"><?= format_date($booking['booking_date']) ?> at <?= e($booking['booking_time']) ?></strong>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block" style="font-size:0.8rem;">Devotee Name</label>
                    <strong class="fs-6"><?= e($booking['customer_name']) ?></strong>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block" style="font-size:0.8rem;">Contact Info</label>
                    <div><i class="bi bi-telephone text-gold me-1"></i><?= e($booking['customer_phone']) ?></div>
                    <div><i class="bi bi-envelope text-gold me-1"></i><?= e($booking['customer_email']) ?></div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block" style="font-size:0.8rem;">Dakshina (Amount)</label>
                    <strong class="fs-5 text-crimson"><?= format_currency($booking['amount']) ?></strong>
                    <span class="badge bg-light text-dark ms-2"><?= strtoupper(str_replace('_', ' ', e($booking['payment_status']))) ?></span>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block" style="font-size:0.8rem;">Booking Status</label>
                    <span class="status-badge status-<?= e($booking['booking_status']) ?> fs-6">
                        <?= strtoupper(e($booking['booking_status'])) ?>
                    </span>
                </div>
            </div>

            <?php if (!empty($booking['special_requests'])): ?>
            <div class="p-3 bg-light rounded-3 border mb-4">
                <strong class="text-crimson d-block mb-1">Sankalp / Gotra / Special Requests:</strong>
                <p class="mb-0 text-slate" style="font-size:0.92rem;"><?= nl2br(e($booking['special_requests'])) ?></p>
            </div>
            <?php endif; ?>

            <div class="p-3 bg-gold-pale rounded-3 border">
                <small class="text-slate d-block mb-1"><strong>Priest Instructions:</strong></small>
                <small class="text-slate">Verify the booking voucher at Temple Seva Counter #2. Ensure gotra sankalp is completed prior to the panchamrit abhishek.</small>
            </div>
        </div>
    </div>

    <!-- Status Update Form -->
    <div class="col-lg-4">
        <div class="admin-form-card mb-4">
            <div class="form-card-header">
                <i class="bi bi-pencil-square"></i> Update Booking Status
            </div>
            <div class="form-card-body">
                <form action="<?= url('admin?action=bookings') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="update_status">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label-admin">Booking Status</label>
                        <select name="booking_status" class="form-select-admin">
                            <option value="pending" <?= ($booking['booking_status'] === 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="confirmed" <?= ($booking['booking_status'] === 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                            <option value="completed" <?= ($booking['booking_status'] === 'completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= ($booking['booking_status'] === 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-admin">Payment Status</label>
                        <select name="payment_status" class="form-select-admin">
                            <option value="pending" <?= ($booking['payment_status'] === 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="paid" <?= ($booking['payment_status'] === 'paid') ? 'selected' : '' ?>>Paid (Online / Cash Received)</option>
                            <option value="cash_at_temple" <?= ($booking['payment_status'] === 'cash_at_temple') ? 'selected' : '' ?>>Pay at Temple</option>
                            <option value="failed" <?= ($booking['payment_status'] === 'failed') ? 'selected' : '' ?>>Failed / Refunded</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-admin-primary w-100">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
