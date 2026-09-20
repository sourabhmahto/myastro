<?php
/**
 * Hotel / Ashram Detail View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('hotels') ?>" class="text-white-50">Hotels</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= e($hotel['name']) ?></li>
            </ol>
        </nav>
        <h1><?= e($hotel['name']) ?></h1>
        <p class="mb-0"><i class="bi bi-geo-alt-fill text-gold me-1"></i><?= e($hotel['address']) ?> &nbsp;|&nbsp; Tariffs: <?= e($hotel['price_range']) ?></p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border mb-4">
                    <img src="<?= e(upload_url($hotel['image'], 'default-place.svg')) ?>" alt="<?= e($hotel['name']) ?>" class="rounded-3 w-100 mb-4 shadow-sm" style="max-height:420px;object-fit:cover;">

                    <h3 class="text-crimson mb-3">About This Accommodation</h3>
                    <div class="text-slate mb-4" style="line-height:1.8;font-size:0.95rem;">
                        <?= nl2br(e($hotel['description'])) ?>
                    </div>

                    <?php if (!empty($hotel['amenities'])): ?>
                    <h4 class="text-crimson mb-3"><i class="bi bi-stars text-gold me-2"></i>Facilities &amp; Amenities</h4>
                    <div class="p-3 bg-ivory rounded-3 border mb-4">
                        <ul class="row g-2 mb-0 list-unstyled" style="font-size:0.92rem;">
                            <?php foreach (explode(',', $hotel['amenities']) as $amenity): ?>
                            <li class="col-sm-6 text-slate"><i class="bi bi-check-circle-fill text-teal me-2"></i><?= e(trim($amenity)) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="p-3 bg-gold-pale rounded-3 border">
                        <h6 class="text-crimson mb-1"><i class="bi bi-geo-alt-fill text-gold me-2"></i>Location &amp; Address</h6>
                        <p class="text-slate mb-0" style="font-size:0.9rem;"><?= e($hotel['address']) ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm border mb-4 sticky-top" style="top:90px;border-top:4px solid var(--color-crimson) !important;">
                    <h5 class="text-crimson mb-3"><i class="bi bi-telephone-inbound text-gold me-2"></i>Direct Booking / Inquiry</h5>
                    
                    <div class="mb-2 pb-2 border-bottom">
                        <small class="text-slate d-block">Estimated Price Range</small>
                        <strong class="text-crimson fs-5"><?= e($hotel['price_range']) ?></strong>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-slate d-block">Contact Phone</small>
                        <strong class="fs-6"><?= e($hotel['phone']) ?></strong>
                    </div>

                    <a href="tel:<?= e($hotel['phone']) ?>" class="btn-crimson w-100 text-center text-decoration-none d-block py-2 mb-2">
                        <i class="bi bi-telephone-fill me-1"></i>Call Property Directly
                    </a>

                    <a href="<?= url('booking') ?>" class="btn-gold w-100 text-center text-decoration-none d-block py-2">
                        <i class="bi bi-calendar-check me-1"></i>Book Temple Darshan
                    </a>

                    <hr class="my-3">

                    <h6 class="text-crimson mb-2">Other Recommended Stays</h6>
                    <ul class="list-unstyled mb-0" style="font-size:0.88rem;">
                        <?php if (!empty($allHotels)): foreach (array_slice($allHotels, 0, 4) as $ah): if ($ah['id'] !== $hotel['id']): ?>
                        <li class="py-1">
                            <a href="<?= url('hotels/' . $ah['slug']) ?>" class="text-decoration-none text-slate d-flex justify-content-between">
                                <span><?= e($ah['name']) ?></span>
                                <small class="text-gold"><?= e($ah['price_range']) ?></small>
                            </a>
                        </li>
                        <?php endif; endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
