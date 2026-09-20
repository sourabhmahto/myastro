<?php
/**
 * Terms and Conditions View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Terms &amp; Conditions</li>
            </ol>
        </nav>
        <h1>Terms &amp; Conditions</h1>
        <p class="mb-0">Pilgrimage guidelines, booking terms, and temple decorum.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border text-slate" style="line-height:1.8;font-size:0.95rem;">
                    <h4 class="text-crimson mb-3">1. Pilgrimage Booking &amp; Passes</h4>
                    <p>All online Pooja and Darshan bookings generate an official digital reference voucher. Devotees are requested to arrive at the designated Seva Counter at least 30 minutes prior to the scheduled ritual start time.</p>

                    <h4 class="text-crimson mb-3">2. Temple Decorum &amp; Conduct</h4>
                    <p>Devotees are expected to maintain strict spiritual sanctity, reverence, and follow temple security directives. Photography and videography inside the inner Garbhagriha are strictly prohibited in adherence to temple administration rules.</p>

                    <h4 class="text-crimson mb-3">3. Rescheduling &amp; Cancellations</h4>
                    <p>In case of unexpected travel delays or emergencies, devotees can request a time slot adjustment by contacting our helpline at least 6 hours prior to the booked slot. Rescheduling is subject to slot availability.</p>

                    <h4 class="text-crimson mb-3">4. Force Majeure</h4>
                    <p>In rare events of high river currents, heavy monsoonal flood warnings, or government administrative security closures, ritual schedules may be relocated or adjusted for the safety of pilgrims.</p>

                    <h4 class="text-crimson mb-3">5. Jurisdiction</h4>
                    <p>Any disputes arising out of pilgrimage services are subject to the exclusive jurisdiction of the courts in Khandwa District, Madhya Pradesh.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
