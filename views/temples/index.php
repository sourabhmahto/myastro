<?php
/**
 * Temples Listing View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Temples</li>
            </ol>
        </nav>
        <h1>Sacred Temples of Omkareshwar</h1>
        <p class="mb-0">Explore the ancient sanctums, Jyotirlinga shrines, and historic monuments of Mandhata Island.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($temples)): foreach ($temples as $temple): ?>
            <div class="col-lg-4 col-md-6">
                <div class="temple-card h-100 d-flex flex-column">
                    <div class="temple-card-img-wrap">
                        <img src="<?= e(upload_url($temple['featured_image'], 'default-temple.svg')) ?>" alt="<?= e($temple['name']) ?>" loading="lazy">
                        <span class="temple-card-badge">Jyotirlinga Sanctum</span>
                    </div>
                    <div class="temple-card-body flex-grow-1 d-flex flex-column">
                        <h4><?= e($temple['name']) ?></h4>
                        <div class="temple-timings mb-2">
                            <i class="bi bi-clock"></i> <?= format_time($temple['opening_time']) ?> – <?= format_time($temple['closing_time']) ?>
                        </div>
                        <p class="text-slate flex-grow-1" style="font-size:0.88rem;"><?= e($temple['short_description']) ?></p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="<?= url('temples/' . $temple['slug']) ?>" class="btn-outline-crimson text-decoration-none flex-fill text-center" style="padding:0.5rem 0.8rem;font-size:0.84rem;">
                                Temple Details
                            </a>
                            <a href="<?= url('booking') ?>" class="btn-crimson text-decoration-none flex-fill text-center" style="padding:0.5rem 0.8rem;font-size:0.84rem;">
                                <i class="bi bi-calendar-check me-1"></i>Book Pooja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-slate">No temples found at the moment.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
