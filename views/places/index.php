<?php
/**
 * Places to Visit Listing View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Places to Visit</li>
            </ol>
        </nav>
        <h1>Places to Visit Around Omkareshwar</h1>
        <p class="mb-0">Explore Mandhata Island Parikrama path, suspension bridges, sangam ghats, and historical caves.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($places)): foreach ($places as $place): ?>
            <div class="col-lg-4 col-md-6">
                <div class="place-card h-100 d-flex flex-column">
                    <div class="place-card-img">
                        <img src="<?= e(upload_url($place['image'], 'default-place.svg')) ?>" alt="<?= e($place['name']) ?>" loading="lazy">
                    </div>
                    <div class="place-card-body flex-grow-1 d-flex flex-column">
                        <span class="distance-pill"><i class="bi bi-geo-alt-fill me-1"></i><?= e($place['distance_from_temple']) ?></span>
                        <h5><?= e($place['name']) ?></h5>
                        <p class="text-slate flex-grow-1" style="font-size:0.88rem;"><?= e(mb_substr($place['description'], 0, 140)) ?>…</p>
                        <div class="mt-2">
                            <a href="<?= url('places/' . $place['slug']) ?>" class="btn-outline-crimson d-block text-center text-decoration-none" style="padding:0.45rem 1rem;font-size:0.84rem;">
                                Explore Details <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-slate">No places listed at the moment.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
