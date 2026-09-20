<?php
/**
 * Temple Detail View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('temples') ?>" class="text-white-50">Temples</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= e($temple['name']) ?></li>
            </ol>
        </nav>
        <h1><?= e($temple['name']) ?></h1>
        <p class="mb-0"><i class="bi bi-geo-alt-fill text-gold me-1"></i><?= e($temple['address']) ?></p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border mb-4">
                    <img src="<?= e(upload_url($temple['featured_image'], 'default-temple.svg')) ?>" alt="<?= e($temple['name']) ?>" class="rounded-3 w-100 mb-4 shadow-sm" style="max-height:420px;object-fit:cover;">

                    <h3 class="text-crimson mb-3">Sanctum Overview & History</h3>
                    <div class="text-slate" style="line-height:1.8;font-size:0.95rem;">
                        <?= nl2br(e($temple['description'])) ?>
                    </div>

                    <div class="divider-om my-4"><span>ॐ</span></div>

                    <h4 class="text-crimson mb-3">Darshan Guidelines & Protocol</h4>
                    <ul class="text-slate" style="font-size:0.92rem;line-height:1.7;">
                        <li>Devotees are advised to take a holy snan (dip) in River Narmada prior to entering the inner sanctum.</li>
                        <li>Traditional clothing is encouraged: Dhoti/Pitambar for men inside the Garbhagriha, Saree or Salwar suit for women.</li>
                        <li>Mobile phones, electronic devices, and photography are strictly restricted inside the sanctum sanctorum.</li>
                        <li>Special queues are maintained for senior citizens, differently-abled pilgrims, and devotees with infant children.</li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar Info & Booking CTA -->
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm border mb-4" style="border-top:4px solid var(--color-gold) !important;">
                    <h5 class="text-crimson mb-3"><i class="bi bi-info-circle text-gold me-2"></i>Temple Information</h5>
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-slate d-block">Daily Opening Hours</small>
                        <strong class="text-crimson"><i class="bi bi-clock me-1"></i><?= format_time($temple['opening_time']) ?> – <?= format_time($temple['closing_time']) ?></strong>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-slate d-block">Sanctum Location</small>
                        <strong><?= e($temple['address']) ?></strong>
                    </div>
                    <?php if (!empty($temple['latitude']) && !empty($temple['longitude'])): ?>
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-slate d-block">Geo Coordinates</small>
                        <code><?= e($temple['latitude']) ?>, <?= e($temple['longitude']) ?></code>
                    </div>
                    <?php endif; ?>
                    <a href="<?= url('booking') ?>" class="btn-gold w-100 text-center text-decoration-none d-block mb-2">
                        <i class="bi bi-calendar-check me-1"></i>Book Vedic Pooja
                    </a>
                    <a href="tel:<?= e(CONTACT_PHONE) ?>" class="btn-outline-crimson w-100 text-center text-decoration-none d-block">
                        <i class="bi bi-telephone me-1"></i>Call Helpline
                    </a>
                </div>

                <!-- Google Maps / Location Embed -->
                <div class="bg-white p-3 rounded-3 shadow-sm border mb-4">
                    <h6 class="text-crimson mb-2"><i class="bi bi-map-fill text-gold me-2"></i>Location Map</h6>
                    <div class="ratio ratio-4x3 rounded-2 overflow-hidden">
                        <iframe src="<?= e(GOOGLE_MAPS_EMBED_URL) ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Omkareshwar Location Map"></iframe>
                    </div>
                </div>

                <!-- Other Temples -->
                <div class="bg-white p-4 rounded-3 shadow-sm border">
                    <h6 class="text-crimson mb-3">Other Sacred Shrines</h6>
                    <ul class="list-unstyled mb-0">
                        <?php if (!empty($allTemples)): foreach ($allTemples as $t): if ($t['id'] !== $temple['id']): ?>
                        <li class="mb-2 pb-2 border-bottom">
                            <a href="<?= url('temples/' . $t['slug']) ?>" class="text-decoration-none text-slate d-flex align-items-center justify-content-between">
                                <span><?= e($t['name']) ?></span>
                                <i class="bi bi-chevron-right text-gold" style="font-size:0.75rem;"></i>
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
