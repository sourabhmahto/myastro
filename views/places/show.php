<?php
/**
 * Place Detail View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('places') ?>" class="text-white-50">Places to Visit</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= e($place['name']) ?></li>
            </ol>
        </nav>
        <h1><?= e($place['name']) ?></h1>
        <p class="mb-0"><i class="bi bi-geo-alt-fill text-gold me-1"></i><?= e($place['location']) ?> (<?= e($place['distance_from_temple']) ?> from Temple)</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border mb-4">
                    <img src="<?= e(upload_url($place['image'], 'default-place.svg')) ?>" alt="<?= e($place['name']) ?>" class="rounded-3 w-100 mb-4 shadow-sm" style="max-height:420px;object-fit:cover;">

                    <h3 class="text-crimson mb-3">About This Attraction</h3>
                    <div class="text-slate" style="line-height:1.8;font-size:0.95rem;">
                        <?= nl2br(e($place['description'])) ?>
                    </div>

                    <div class="divider-om my-4"><span>ॐ</span></div>

                    <div class="p-3 bg-gold-pale rounded-3 border">
                        <h6 class="text-crimson mb-1"><i class="bi bi-compass-fill text-gold me-2"></i>How to Reach from Main Temple</h6>
                        <p class="text-slate mb-0" style="font-size:0.9rem;">This location is situated at <strong><?= e($place['location']) ?></strong>, approximately <strong><?= e($place['distance_from_temple']) ?></strong> from the main Omkareshwar Jyotirlinga shrine. It can be easily accessed via walking along the parikrama path or local auto/boat transport.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm border mb-4" style="border-top:4px solid var(--color-gold) !important;">
                    <h5 class="text-crimson mb-3"><i class="bi bi-info-circle text-gold me-2"></i>Key Information</h5>
                    <div class="mb-2 pb-2 border-bottom">
                        <small class="text-slate d-block">Distance from Jyotirlinga</small>
                        <strong class="text-crimson"><?= e($place['distance_from_temple']) ?></strong>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-slate d-block">Location Area</small>
                        <strong><?= e($place['location']) ?></strong>
                    </div>
                    <a href="<?= url('booking') ?>" class="btn-crimson w-100 text-center text-decoration-none d-block mb-2">
                        <i class="bi bi-calendar-check me-1"></i>Book Darshan &amp; Pooja
                    </a>
                </div>

                <div class="bg-white p-4 rounded-3 shadow-sm border">
                    <h6 class="text-crimson mb-3">Other Nearby Places</h6>
                    <ul class="list-unstyled mb-0" style="font-size:0.88rem;">
                        <?php if (!empty($allPlaces)): foreach ($allPlaces as $ap): if ($ap['id'] !== $place['id']): ?>
                        <li class="py-2 border-bottom">
                            <a href="<?= url('places/' . $ap['slug']) ?>" class="text-decoration-none text-slate d-flex justify-content-between align-items-center">
                                <span><?= e($ap['name']) ?></span>
                                <small class="text-gold"><?= e($ap['distance_from_temple']) ?></small>
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
