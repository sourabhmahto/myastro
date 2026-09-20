<?php
/**
 * Hotels & Accommodations Listing View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Hotels &amp; Accommodations</li>
            </ol>
        </nav>
        <h1>Hotels, Ashrams &amp; Dharamshalas</h1>
        <p class="mb-0">Find clean, peaceful, and convenient accommodations in Omkareshwar for families and pilgrims.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($hotels)): foreach ($hotels as $hotel): ?>
            <div class="col-lg-4 col-md-6">
                <div class="hotel-card h-100 d-flex flex-column">
                    <div class="hotel-card-img">
                        <img src="<?= e(upload_url($hotel['image'], 'default-place.svg')) ?>" alt="<?= e($hotel['name']) ?>" loading="lazy">
                    </div>
                    <div class="hotel-card-body flex-grow-1 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="mb-0"><?= e($hotel['name']) ?></h5>
                        </div>
                        <div class="hotel-price mb-2"><i class="bi bi-tag-fill me-1"></i><?= e($hotel['price_range']) ?></div>
                        <p class="text-slate flex-grow-1" style="font-size:0.88rem;"><?= e(mb_substr($hotel['description'], 0, 130)) ?>…</p>
                        
                        <?php if (!empty($hotel['amenities'])): ?>
                        <div class="hotel-amenities mb-3">
                            <i class="bi bi-check2-circle text-teal me-1"></i><?= e(mb_substr($hotel['amenities'], 0, 70)) ?>
                        </div>
                        <?php endif; ?>

                        <div class="d-flex gap-2 mt-auto">
                            <a href="<?= url('hotels/' . $hotel['slug']) ?>" class="btn-outline-crimson text-decoration-none flex-fill text-center" style="padding:0.45rem 0.8rem;font-size:0.84rem;">
                                View Details
                            </a>
                            <a href="tel:<?= e($hotel['phone']) ?>" class="btn-crimson text-decoration-none flex-fill text-center" style="padding:0.45rem 0.8rem;font-size:0.84rem;">
                                <i class="bi bi-telephone-fill me-1"></i>Call
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-slate">No accommodations listed at the moment.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
