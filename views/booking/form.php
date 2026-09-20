<?php
/**
 * Online Booking Wizard View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Online Booking</li>
            </ol>
        </nav>
        <h1>Online Pooja & Darshan Booking</h1>
        <p class="mb-0">Reserve your Vedic ritual time slot at Shree Omkareshwar Jyotirlinga. Instant confirmed digital Darshan pass.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="booking-form-card">
                    <div class="form-header text-center">
                        <div class="om-text fs-2 text-gold mb-1">ॐ नमः शिवाय</div>
                        <h3 class="text-white mb-1">Vedic Pooja Reservation</h3>
                        <small class="text-white-50">Fill in your details below to schedule your auspicious darshan and pooja.</small>
                    </div>

                    <div class="form-body">
                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step-dot active" id="dot-0">
                                <span>1</span> Service &amp; Date
                            </div>
                            <div class="step-dot" id="dot-1">
                                <span>2</span> Devotee Info
                            </div>
                            <div class="step-dot" id="dot-2">
                                <span>3</span> Review &amp; Confirm
                            </div>
                        </div>

                        <form action="<?= url('booking/store') ?>" method="POST" id="mainBookingForm">
                            <?= csrf_field() ?>

                            <!-- STEP 1: Service, Date & Slot -->
                            <div class="booking-step" id="step-0">
                                <h5 class="text-crimson mb-3"><i class="bi bi-flower1 text-gold me-2"></i>Select Pooja Service &amp; Date</h5>

                                <div class="mb-3">
                                    <label for="pooja_service_id" class="form-label fw-bold">Pooja / Darshan Ritual <span class="text-danger">*</span></label>
                                    <select class="form-select" id="pooja_service_id" name="pooja_service_id" required>
                                        <option value="">-- Choose Pooja Service --</option>
                                        <?php if (!empty($poojas)): foreach ($poojas as $p): ?>
                                            <option value="<?= e($p['id']) ?>" 
                                                data-price="<?= e($p['price']) ?>" 
                                                data-duration="<?= e($p['duration']) ?>"
                                                <?= ($selectedPooja && $selectedPooja['id'] == $p['id']) ? 'selected' : '' ?>>
                                                <?= e($p['name']) ?> — <?= format_currency($p['price']) ?> (<?= e($p['duration']) ?>)
                                            </option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="booking_date" class="form-label fw-bold">Pilgrimage Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="booking_date" name="booking_date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                                    <small class="text-muted">Same-day and advance bookings are accepted.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Select Auspicious Time Slot <span class="text-danger">*</span></label>
                                    <input type="hidden" id="booking_time" name="booking_time" value="07:30 AM" required>
                                    <div class="time-slot-grid">
                                        <!-- Generated dynamically by main.js with fallback buttons -->
                                        <button type="button" class="time-slot-btn" data-time="06:00 AM">06:00 AM</button>
                                        <button type="button" class="time-slot-btn selected" data-time="07:30 AM">07:30 AM</button>
                                        <button type="button" class="time-slot-btn" data-time="09:00 AM">09:00 AM</button>
                                        <button type="button" class="time-slot-btn" data-time="10:30 AM">10:30 AM</button>
                                        <button type="button" class="time-slot-btn" data-time="02:00 PM">02:00 PM</button>
                                        <button type="button" class="time-slot-btn" data-time="04:30 PM">04:30 PM</button>
                                        <button type="button" class="time-slot-btn" data-time="06:00 PM">06:00 PM</button>
                                        <button type="button" class="time-slot-btn" data-time="07:30 PM">07:30 PM</button>
                                    </div>
                                </div>

                                <div class="price-summary-box">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="text-slate d-block">Estimated Dakshina:</span>
                                            <strong id="display-pooja-name" class="text-crimson">Please select a service</strong>
                                            <small id="display-duration" class="text-muted d-block"></small>
                                        </div>
                                        <div class="total-price" id="display-price">₹ 0</div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn-crimson" data-next-step>
                                        Continue to Devotee Details <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 2: Devotee Info -->
                            <div class="booking-step" id="step-1" style="display:none;">
                                <h5 class="text-crimson mb-3"><i class="bi bi-person-fill text-gold me-2"></i>Devotee &amp; Sankalp Information</h5>

                                <div class="mb-3">
                                    <label for="customer_name" class="form-label fw-bold">Primary Devotee Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="e.g. Ramesh Chandra Sharma" required>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="customer_phone" class="form-label fw-bold">Mobile Number (WhatsApp) <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="customer_phone" name="customer_phone" placeholder="+91 98765 43210" required>
                                        <small class="text-muted">For booking confirmation SMS/WhatsApp pass.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="customer_email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="devotee@example.com" required>
                                        <small class="text-muted">Voucher and Darshan slip will be emailed.</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="special_requests" class="form-label fw-bold">Gotra / Sankalp / Special Assistance (Optional)</label>
                                    <textarea class="form-control" id="special_requests" name="special_requests" rows="3" placeholder="Mention Gotra, Nakshatra, or any wheelchair/senior citizen assistance required..."></textarea>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn-outline-crimson" data-prev-step>
                                        <i class="bi bi-arrow-left me-1"></i> Back
                                    </button>
                                    <button type="button" class="btn-crimson" data-next-step>
                                        Proceed to Review <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 3: Review & Payment Option -->
                            <div class="booking-step" id="step-2" style="display:none;">
                                <h5 class="text-crimson mb-3"><i class="bi bi-check2-circle text-gold me-2"></i>Review &amp; Confirm Booking</h5>

                                <div class="p-3 bg-white rounded-3 border mb-3">
                                    <h6 class="text-crimson mb-2">Payment Option</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method" id="pay_temple" value="cash_at_temple" checked>
                                        <label class="form-check-label" for="pay_temple">
                                            <strong>Pay at Temple Seva Kendra (Cash / UPI on arrival)</strong>
                                            <small class="d-block text-muted">Pay directly to our certified priest counter before commencing the ritual.</small>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="pay_online" value="online">
                                        <label class="form-check-label" for="pay_online">
                                            <strong>Pre-paid Online Booking (Instant Confirmation)</strong>
                                            <small class="d-block text-muted">Mark as pre-verified online booking.</small>
                                        </label>
                                    </div>
                                </div>

                                <div class="alert alert-info border-0 shadow-sm">
                                    <i class="bi bi-shield-check text-teal me-2"></i>
                                    <strong>Safe &amp; Verified:</strong> All poojas are conducted according to strict Vedic Shastras with pure samagri. Instant booking slip with reference code will be generated.
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn-outline-crimson" data-prev-step>
                                        <i class="bi bi-arrow-left me-1"></i> Back
                                    </button>
                                    <button type="submit" class="btn-gold" style="font-size:1rem;font-weight:700;padding:0.75rem 2.2rem;">
                                        <i class="bi bi-lock-fill me-1"></i>Confirm &amp; Generate Darshan Pass
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assistance Callout -->
                <div class="text-center mt-4">
                    <p class="text-slate mb-1"><i class="bi bi-headset me-1 text-gold"></i>Need help with your booking?</p>
                    <a href="tel:<?= e(CONTACT_PHONE) ?>" class="text-crimson fw-bold text-decoration-none">
                        Call Temple Seva Coordinator: <?= e(CONTACT_PHONE) ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
