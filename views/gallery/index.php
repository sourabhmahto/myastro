<?php
/**
 * Gallery View with Category Filter & Responsive Lightbox Modal
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Photo Gallery</li>
            </ol>
        </nav>
        <h1>Sacred Photo Gallery of Omkareshwar</h1>
        <p class="mb-0">Darshan of sacred shrines, evening Narmada Maha Aarti, scenic ghats, and Vedic ceremonies.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <!-- Category Filter Buttons -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
            <button type="button" class="gallery-filter-btn <?= ($selectedCategory === 'all') ? 'active' : '' ?>" data-category="all">All Photos</button>
            <button type="button" class="gallery-filter-btn <?= ($selectedCategory === 'temples') ? 'active' : '' ?>" data-category="temples">Temples &amp; Shrines</button>
            <button type="button" class="gallery-filter-btn <?= ($selectedCategory === 'aarti') ? 'active' : '' ?>" data-category="aarti">Narmada Aarti</button>
            <button type="button" class="gallery-filter-btn <?= ($selectedCategory === 'river_narmada') ? 'active' : '' ?>" data-category="river_narmada">River &amp; Ghats</button>
            <button type="button" class="gallery-filter-btn <?= ($selectedCategory === 'parikrama') ? 'active' : '' ?>" data-category="parikrama">Mandhata Parikrama</button>
            <button type="button" class="gallery-filter-btn <?= ($selectedCategory === 'rituals') ? 'active' : '' ?>" data-category="rituals">Vedic Rituals</button>
        </div>

        <!-- Gallery Grid -->
        <div class="row g-3">
            <?php if (!empty($galleries)): foreach ($galleries as $g): ?>
            <div class="col-6 col-md-4 col-lg-3 gallery-item" data-category="<?= e($g['category']) ?>">
                <div class="card border-0 shadow-sm overflow-hidden h-100 position-relative rounded-3" style="height:230px;">
                    <img src="<?= e(upload_url($g['image'], 'default-temple.svg')) ?>" alt="<?= e($g['alt_text']) ?>" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
                    <div class="gallery-overlay">
                        <i class="bi bi-zoom-in text-white fs-2"></i>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-slate">No photos found in this category.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal Container -->
<div class="gallery-lightbox" role="dialog" aria-modal="true" aria-label="Photo Lightbox">
    <button class="lightbox-close" aria-label="Close">&times;</button>
    <img src="" alt="" style="max-width:90vw;max-height:85vh;border-radius:12px;object-fit:contain;">
    <p class="lightbox-caption text-white text-center mt-3"></p>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
