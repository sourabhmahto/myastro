<?php
/**
 * Pooja Services Listing View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Pooja Services</li>
            </ol>
        </nav>
        <h1>Vedic Pooja & Darshan Services</h1>
        <p class="mb-0">Authentic rituals performed by verified Vedic Brahmin pandits on the banks of sacred Narmada.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($poojas)): foreach ($poojas as $pooja): ?>
            <div class="col-lg-4 col-md-6">
                <div class="pooja-card">
                    <div class="pooja-card-img-wrap">
                        <img src="<?= e(upload_url($pooja['image'], 'default-pooja.svg')) ?>" alt="<?= e($pooja['name']) ?>" loading="lazy">
                        <div class="pooja-price-badge"><?= format_currency($pooja['price']) ?></div>
                    </div>
                    <div class="pooja-card-body">
                        <h4><?= e($pooja['name']) ?></h4>
                        <div class="pooja-meta">
                            <span><i class="bi bi-clock me-1 text-teal"></i><?= e($pooja['duration']) ?></span>
                            <?php if (!empty($pooja['samagri_included'])): ?>
                            <span><i class="bi bi-box-seam me-1 text-gold"></i>Samagri Included</span>
                            <?php endif; ?>
                        </div>
                        <p><?= e(mb_substr($pooja['description'], 0, 130)) ?>…</p>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="<?= url('pooja-services/' . $pooja['slug']) ?>" class="btn-outline-crimson text-decoration-none flex-fill text-center" style="padding:0.5rem 0.8rem;font-size:0.84rem;">
                                View Details
                            </a>
                            <a href="<?= url('booking?service=' . $pooja['slug']) ?>" class="btn-crimson text-decoration-none flex-fill text-center" style="padding:0.5rem 0.8rem;font-size:0.84rem;">
                                <i class="bi bi-calendar-check me-1"></i>Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-slate">No pooja services available at the moment.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
